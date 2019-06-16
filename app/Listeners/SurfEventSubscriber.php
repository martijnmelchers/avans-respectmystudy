<?php

namespace App\Listeners;
use App\SurfAttribute;
use App\SurfUser;
use App\Role;
class SurfEventSubscriber
{

    // Deze rollen worden geaccepteerd uit surf
    private static $acceptedRoles = [
        "student" => [
            "desc" => "Iedereen die studeert aan een hogeschool",
            "assign" => "Student",
        ],
        "faculty" => [
            "desc" => "Docenten, PhD students",
            "assign" => "asscessor",
        ],
    ];


    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {
        

        // Als de gebruiker niet is ingelogd, breng hem naar de login pagina.
        if(!\Auth::check()){
            return redirect('/login');
        }
        
        $messageId = $event->getSaml2Auth()->getLastMessageId();
        // your own code preventing reuse of a $messageId to stop replay attacks
        $user = $event->getSaml2User();
        $userData = [
            'id' => $user->getUserId(),
            'attributes' => $user->getAttributes(),
            'assertion' => $user->getRawSamlAssertion()
        ];
        
        $surfUserCheck = SurfUser::where('surf_id','=',$userData['id'])->first();

        if($surfUserCheck == null || $surfUserCheck->user_id == \Auth::id()){
                
            if(isset(\Auth::user()->surfUser)){
                // Doe niks, we kunnen dan de attributes gewoon toevoegen.
            }

            else {
                $surfUser = new SurfUser();
                $surfUser->user_id = \Auth::id();
                $surfUser->surf_id = $userData['id'];
                $surfUser->save();
            }
        
            foreach($userData['attributes'] as $key => $value ){

                
                // If we already have an attribute like this stored.
                if($this->surfattrExists($userData['id'], $value)){
                    continue;
                }

                // This is the 'role' key so handle role_verification here.
                if($key === "urn:mace:dir:attribute-def:eduPersonAffiliation"){
                    $role = $this->getSurfRole($value);
                    
                    // If we have a valid role.
                    if($role !== false){
                        //TODO: handle role assignment.
                        $role_id = Role::where('role_name', $role['assign'])->first()->id;
                        
                        // Assign the role to the user and update the user.
                        $currentUser = \Auth::user();
                        $currentUser->role_id = $role_id;
                        $currentUser->role_verified_surf = true;
                        $currentUser->save();
                    }
                    else{
                        // No valid role found, just assign them "unverified student"
                    }
                }

                $surfAttr = new SurfAttribute();
                $surfAttr->surf_id = $userData['id'];
                $surfAttr->surf_key = $key;
                $surfAttr->surf_value = $value[0];

                $surfAttr->save();
            }
        
        }

        else {
            // Dit surf account is al aan iemand gelinked. Geef eenw warning.
            
        }
    }

    // Helper function to check if we have an attribute stored already.
    private function surfattrExists($surfuserID, $surfattrKey){
        $surfAttrFind = SurfAttribute::where([['surf_id', '=', $surfuserID], ['surf_key', '=' , $surfattrKey]])->first();
        return $surfAttrFind != null;
    }

    private function getSurfRole($roles){
        foreach($roles as $role){
            foreach(self::$acceptedRoles as $key => $content){
                if($role == $key){
                    return $content;
                }
            }
        }
        return false;  
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Aacotroneo\Saml2\Events\Saml2LoginEvent',
            'App\Listeners\SurfEventSubscriber@onUserLogin'
        );
    }
}