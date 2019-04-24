<?php

namespace App\Listeners;
use App\SurfAttribute;
use App\SurfUser;

class SurfEventSubscriber
{
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

                $sufAttrFind = SurfAttribute::where([['surf_id', '=', $userData['id']], ['surf_key', '=' , $key]])->first();

                if($sufAttrFind != null){
                    continue;
                }

                $surfAttr = new SurfAttribute();
                $surfAttr->surf_id = $userData['id'];
                $surfAttr->surf_key = $key;
                $surfAttr->surf_value = $value[0];

                $surfAttr->save();
            }
        
        }
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