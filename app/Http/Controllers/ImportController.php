<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\ContactPerson;
use App\Location;
use App\Minor;
use App\Organisation;
use App\Tag;

class ImportController extends Controller
{
    public function Minors()
    {
        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/module/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }

        $errors = $messages = [];

        // Loop through all minors
        foreach ($php_result->results as $r) {
            // Select the minor
            $minor = Minor::orderBy('version', 'desc')->where('id', $r->id)->first();

            $messages[] = "Minor {$r->name} already exists";

            // Check if minor is set, if already in database
            if (isset($minor)) {
                // Check if minor has changed
                if (!$minor->isSame($r)) {

                    // Calculate new version
                    $newVersion = $minor->version + 1;

                    $messages[] = "Minor {$r->id} is veranderd, dus versie $newVersion is aangemaakt";

                    // Check if the contact group exists, and get the id if it does
                    $contact_group_id = null;
                    if ($r->contact != null) {
                        $contact_group = ContactGroup::where("id", $r->contact)->first();
                        if ($contact_group_id != null) $contact_group_id = $contact_group->id;
                        else $messages[] = "Contactgroup $r->contact niet gevonden";
                    }

                    // Create new minor
                    $minor = new Minor([
                        "id" => $r->id,
                        "version" => $newVersion,
                        "name" => $r->name,
                        "phonenumber" => "",
                        "email" => "",
                        "kiesopmaat" => $r->id,
                        "ects" => $r->ects,
                        "costs" => $r->costs,
                        "subject" => $r->subject,
                        "goals" => $r->goals,
                        "requirements" => $r->requirements,
                        "examination" => $r->examination,
                        "level" => $r->level,
                        "language" => $r->language,
                        "is_published" => false,
                        "is_enrollable" => false,
                        "organisation_id" => $r->ownedby_organisation,
                        "contact_group_id" => $contact_group_id
                    ]);
                    $minor->save();
                } else {
                    $messages[] = "Minor $r->id is hetzelfde gebleven, dus er is geen nieuwe versie aangemaakt";
                }

                // Delete all locations associated with the minor (to prevent doubles in linking table)
                $minor->locations()->detach();

                // Insert locations of minor
                foreach ($r->locations as $l) {
                    $minor = Minor::where('id', $r->id)->first();

                    $location = Location::find($l);
                    $minor->locations()->attach($location);
                }
            } else {
                // Minor has not been added

                // Get the organisation
                $organisation = Organisation::where("id", $r->ownedby_organisation)->first();

                // Check if organisation exists
                if ($organisation != null) {
                    // Check if the contact group exists, and get the id if it does
                    $contact_group_id = null;
                    if ($r->contact != null) {
                        $contact_group = ContactGroup::where("id", $r->contact)->first();
                        if ($contact_group_id != null)
                            $contact_group_id = $contact_group->id;
                        else
                            $messages[] = "Contactgroep $r->contact niet gevonden";
                    }

                    $minor = new Minor([
                        "id" => $r->id,
                        "version" => 1,
                        "name" => $r->name,
                        "phonenumber" => "",
                        "email" => "",
                        "kiesopmaat" => $r->id,
                        "ects" => $r->ects,
                        "costs" => $r->costs,
                        "subject" => $r->subject,
                        "goals" => $r->goals,
                        "requirements" => $r->requirements,
                        "examination" => $r->examination,
                        "level" => $r->level,
                        "language" => $r->language,
                        "is_published" => false,
                        "is_enrollable" => false,
                        "organisation_id" => $r->ownedby_organisation,
                        "contact_group_id" => $contact_group_id
                    ]);
                    $minor->save();

                    // Insert locations of created minor
                    foreach ($r->locations as $l) {
                        $location = Location::find($l);
                        $minor = Minor::all()->where("id", $r->id)->first();

                        $minor->locations()->attach($location);
                    }
                } else {
                    $errors[] = "Organisatie {$r->ownedby_organisation} niet gevonden";
                }
            }

            // Bind contact group
            if (isset($r->contact)) {
                $contact_group = ContactGroup::where("id", $r->contact)->first();

                if (isset($contact_group)) {
                    $minor = Minor::where("id", $r->id)->first();
                    $minor->contact_group_id = $r->contact;
                    $minor->save();
                    $messages[] = "Contactgroep $r->id toegevoegd!";
                } else {
                    $errors[] = "Contactgroep $r->id niet gevonden!";
                }
            }

            // Bind teachers
            if (isset($r->teachers)) {
                $minor = Minor::all()->where("id", $r->id)->first();

                if (isset($minor)) {
                    $minor->contactPersons()->detach();

                    foreach ($r->teachers as $teacher) {
                        $contact_person = ContactPerson::where("id", $teacher)->first();

                        if (isset($contact_person)) {
                            $minor->contactPersons()->attach($teacher);
                            $minor->save();
                            $messages[] = "Contactpersoon $r->id toegevoegd!";
                        } else {
                            $errors[] = "Contactpersoon $r->id niet gevonden!";
                        }
                    }
                }
            }

            // Bind tags/choicethemes (KOM calls them choicethemes, we call them tags)
            if (isset($r->choicethemes)) {
                $minor = Minor::all()->where("id", $r->id)->first();

                if (isset($minor)) {
                    $minor->tags()->detach();

                    foreach ($r->choicethemes as $choicetheme) {
                        $tag = Tag::where("id", $choicetheme)->first();

                        if (isset($tag)) {
                            $minor->tags()->attach($tag);
                            $minor->save();
                            $messages[] = "Tag $tag->tag toegevoegd!";
                        } else {
                            $errors[] = "Tag $r->id niet gevonden!";
                        }
                    }
                }
            }
        }

        $php_result->errors = $errors;
        $php_result->messages = $messages;

        return response()->json($php_result, 200, [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            ->header('Content-Type', 'text/json');
    }

    public function Organisations()
    {
        $messages = $errors = [];

        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/organisation/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }

        foreach ($php_result->results as $r) {
            $organization = Organisation::all()->where('id', $r->id)->first();
            if (isset($organization)) {
                // Organisatie staat al in de database
            } else {
                $organization = new Organisation([
                    "id" => $r->id,
                    "name" => $r->name,
                    "abbreviation" => $r->abbreviation,
                    "type" => $r->type,
                    "participates" => $r->participates,
                ]);

                if (!$organization->save())
                    $errors[] = "Organisatie {$r->name} kon niet worden toegevoegd.";
            }
        }

        $php_result->messages = $messages;
        $php_result->errors = $errors;
        return response()->json($php_result, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'text/json');
    }

    public function Locations()
    {
        $messages = $errors = [];

        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/location/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }

        foreach ($php_result->results as $r) {
            $location = Location::all()->where('id', $r->id)->first();
            if (isset($location)) {
                $messages[] = "Locatie {$r->name} staat al in de database!";
            } else {
                // Location is not in database

                // Check if organisation has been imported
                if (Organisation::where('id', $r->ownedby_organisation)->get()->count() == 0) {
                    $errors[] = "Locatie {$r->name} kan niet worden geimporteerd omdat de organisatie {$r->ownedby_organisation} niet bestaat!";
                } else {
                    // Create a new location
                    $location = new Location([
                        "id" => $r->id,
                        "name" => $r->name,
                        "primarylocation" => $r->primarylocation,
                        "mailaddress" => $r->mailaddress,
                        "mailcity" => $r->mailcity,
                        "mailzip" => $r->mailzip,
                        "establishment" => 0,
                        "visitingaddress" => $r->visitingaddress,
                        "visitingzip" => $r->visitingzip,
                        "visitingcity" => $r->visitingcity,
                        "organisation_id" => $r->ownedby_organisation,
                    ]);
                    $location->save();
                }
            }

            $location = Location::find($r->id);

            // Check if location already has a location
            if (isset($location) && !isset($location->lat)) {
                // Get location information
                $address = urlencode($location->visitingaddress);
                $postalcode = str_replace(" ", "", $location->visitingzip);

                // Get the google maps API key from the config
                $key = env("GOOGLEMAPS_API_KEY", null);

                if (isset($key)) {
                    $google_php_result = getCurl("https://maps.googleapis.com/maps/api/geocode/json?address=$address%20$postalcode&key=$key");

                    if (sizeof($google_php_result->results) > 0) {
                        foreach ($google_php_result->results as $r) {
                            $lat = floatval($r->geometry->location->lat);
                            $lon = floatval($r->geometry->location->lng);

                            $location->lat = $lat;
                            $location->lon = $lon;
                            $location->save();
                            $messages[] = "{$location->name} heeft een lengte- en breedtegraad gekregen";
                        }
                    } else if (isset($google_php_result->error_message)) {
                        $messages[] = $google_php_result->error_message;
                    }
                } else {
                    $errors[] = "Er is geen google maps API key ingesteld, dus de locaties kunnen niet automatisch een lengte- en breedtegraad krijgen.";
                }
            }
        }

        $php_result->messages = $messages;
        $php_result->errors = $errors;

        return response()->json($php_result, 200, [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            ->header('Content-Type', 'text/json');
    }

    public function ContactPersons()
    {
        $messages = $errors = [];

        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/person/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }

        foreach ($php_result->results as $r) {
            $contactperson = ContactPerson::where("id", $r->id)->first();

            if (isset($contactperson)) {
                $messages[] = "{$r->firstname} {$r->middlename} {$r->lastname} ({$r->id}) staat al in de database";
            } else {
                $organisation = Organisation::where("id", $r->ownedby_organisation)->first();

                // Check if the organisation exists
                if (!isset($organisation)) {
                    $errors[] = "{$r->firstname} {$r->middlename} {$r->lastname} kon niet worden toegevoegd omdat de organisatie {$r->ownedby_organisation} niet bestaat";
                } else {
                    // Add the contact person
                    $contactperson = new ContactPerson([
                        "id" => $r->id,
                        "firstname" => $r->firstname,
                        "middlename" => $r->middlename,
                        "lastname" => $r->lastname,
                        "email" => $r->email,
                        "organisation_id" => $r->ownedby_organisation
                    ]);

                    if (!$contactperson->save())
                        $errors[] = "{$r->firstname} {$r->middlename} {$r->lastname} kon niet worden toegevoegd";
                }
            }
        }

        $php_result->messages = $messages;
        $php_result->errors = $errors;

        return response()->json($php_result, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'text/json');
    }

    public function ContactGroups()
    {
        $messages = $errors = [];

        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/contact/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }

        foreach ($php_result->results as $r) {
            $contactgroup = ContactGroup::where("id", $r->id)->first();

            if (isset($contactgroup)) {
                $contactgroup->update([
                    'name' => $r->name,
                    'description' => $r->description,
                    'email' => $r->email,
                    'postaladdress' => $r->postaladdress,
                    'telephone' => $r->telephone
                ]);

                if (!$contactgroup->save())
                    $errors[] = "Er ging iets mis bij het updaten van $r->name";
            } else {
                $organisation = Organisation::where("id", $r->ownedby_organisation)->first();

                // Check if the organisation exists
                if (!isset($organisation)) {
                    $errors[] = "$r->name ($r->id) kan niet worden toegevoegd omdat de organisatie ($r->ownedby_organisation) niet bestaat";
                } else {
                    $contactgroup = new ContactGroup([
                        'id' => $r->id,
                        'organisation_id' => $r->ownedby_organisation,
                        'name' => $r->name,
                        'description' => $r->description,
                        'email' => $r->email,
                        'postaladdress' => $r->postaladdress,
                        'telephone' => $r->telephone
                    ]);

                    if (!$contactgroup->save())
                        $errors[] = "Er ging iets mis bij het toevoegen van $r->name";
                }
            }
        }

        $php_result->messages = $messages;
        $php_result->errors = $errors;

        return response()->json($php_result, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'text/json');
    }

    public function Tags()
    {
        $messages = $errors = [];

        $page = (isset($_GET['page']) && $_GET['page'] > 0 ? "?page=" . $_GET['page'] : "");
        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $php_result = getCurl("https://www.kiesopmaat.nl/api/public/choicetheme/$page", ["Authorization: Token $kiesopmaat_token"]);

        // Get KIESOPMAAT error
        if (isset($php_result->detail)) {
            return response()->json($php_result);
        }


        foreach ($php_result->results as $r) {
            $tag = Tag::where("id", $r->id)->first();

            if (isset($tag)) {
                $tag->update([
                    'name' => $r->name
                ]);

                if (!$tag->save())
                    $errors[] = "Er ging iets mis bij het updaten van $r->name";
            } else {
                $tag = new Tag([
                    'id' => $r->id,
                    'tag' => $r->name
                ]);

                if (!$tag->save())
                    $errors[] = "Er ging iets mis bij het toevoegen van $r->name";
            }
        }

        $php_result->errors = $errors;
        $php_result->messages = $messages;
        return response()->json($php_result, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ->header('Content-Type', 'text/json');
    }
}

/**
 * @param $url string The url to visit
 * @param array $headers The headers to add
 * @return mixed returns a php object, which is converted from the json that is given from the url
 */
function getCurl($url, $headers = [])
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    $php_result = json_decode($result);

    curl_close($ch);
    return $php_result;
}