<?php

namespace App\Http\Controllers;

use App\Location;
use App\Minor;
use App\Organisation;

class ImportController extends Controller
{
    public function Minors()
    {
        // KiesOpMaat API format: https://hastebin.com/egiyatugam.xml
        header('content-type: application/json');

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $page = "?page=" . $_GET['page'];
        } else {
            $page = "";
        }

        curl_setopt($ch, CURLOPT_URL, "https://www.kiesopmaat.nl/api/public/module/$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Authorization: Token Be6060c3147a74aaec4c15f3531fcc0dcadebe50';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $php_result = json_decode($result);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        if (isset($php_result->detail)) {
            echo $result;
            die();
        }

        $errors = array();

        foreach ($php_result->results as $r) {
            $minor = Minor::orderBy('version', 'desc')->where('id', $r->id)->first();

            // Check if minor is set, if already in database
            if (isset($minor)) {
                // Check if minor has changed
                if (!$minor->isSame($r)) {
                    // Calculate new version
                    $newVersion = $minor->version + 1;

                    // Maak nieuwe minor met hogere versie
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
                    ]);
                    $minor->save();
                }

                // Update locations of minor
                $minor->locations()->detach();

                foreach ($r->locations as $l) {
                    $minor = Minor::where('id', $r->id)->first();

                    $location = Location::find($l);
                    $minor->locations()->attach($location);
                }
            } else {
                $organisation = Organisation::where("id", $r->organisation_id);

                // Check if organisation exists
                if ($organisation != null) {

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
                    ]);
                    $minor->save();

                    // Insert locations
                    foreach ($r->locations as $l) {
                        $location = Location::find($l);
                        $minor = Minor::all()->where("id", $r->id)->first();

                        $minor->locations()->attach($location);
                    }
                } else {
                    $errors[] = "Organisation " . $r->organisation_id . " not found";
                }
            }
        }

        curl_close($ch);

        $php_result->errors = $errors;
        return response(json_encode($php_result), 200)
            ->header('Content-Type', 'text/json');
    }

    public function Organisations()
    {
        // KiesOpMaat API format: https://hastebin.com/ubazezudiq.json
        header('content-type: text/json');

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $page = "?page=" . $_GET['page'];
        } else {
            $page = "";
        }

        curl_setopt($ch, CURLOPT_URL, "https://www.kiesopmaat.nl/api/public/organisation/$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Authorization: Token Be6060c3147a74aaec4c15f3531fcc0dcadebe50';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $php_result = json_decode($result);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        if (isset($php_result->detail)) {
            echo $result;
            die();
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
                $organization->save();
            }
        }

        curl_close($ch);
        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }

    public function Locations()
    {
        // KiesOpMaat API format: https://hastebin.com/egiyatugam.xml
        header('content-type: application/json');

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        if (isset($_GET['s']) && $_GET['s'] > 0) {
            $i = $_GET['s'] . "/";
        } else {
            $i = "";
        }

        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $page = "?page=" . $_GET['page'];
        } else {
            $page = "";
        }

        curl_setopt($ch, CURLOPT_URL, "https://www.kiesopmaat.nl/api/public/location/$i$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();

        $kiesopmaat_token = env('KIESOPMAAT_TOKEN');
        $headers[] = "Authorization: Token $kiesopmaat_token";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $php_result = json_decode($result);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        if (isset($php_result->detail)) {
            header("Content-type: text/json");
            echo $result;
            die();
        }

        $errors = array();

        foreach ($php_result->results as $r) {
            $location = Location::all()->where('id', $r->id)->first();
            if (isset($location)) {
                $curl = curl_init();

                $address = urlencode($r->visitingaddress);
                $postalcode = str_replace(" ", "", $r->visitingzip);
                $key = env("GOOGLEMAPS_API_KEY", null);

                // Get location from Google Maps API if key is set in .env and there isn't already a lat
                if (isset($key)) {
                    // Google maps API voor alle locaties
                    curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=$address%20$postalcode&key=$key");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                    $google_result = curl_exec($ch);
                    $php_result = json_decode($google_result);

                    if (sizeof($php_result->results) > 0) {
                        foreach ($php_result->results as $r) {
                            $lat = floatval($r->geometry->location->lat);
                            $lon = floatval($r->geometry->location->lng);

                            $location->lat = $lat;
                            $location->lon = $lon;
                            $location->save();
                        }
                    }
                }
            } else {
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

                // Google Maps latlong interpretor
                $curl = curl_init();

                $postalcode = str_replace(" ", "", $r->visitingzip);
                $key = env("GOOGLEMAPS_API_KEY", null);

                // Get location from Google Maps API if key is set in .env and there isn't already a lat
                if (isset($key) && !isset($location->lat)) {
                    // Google maps API voor alle locaties
                    curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/geocode/json?address=$postalcode&key=$key");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                    $google_result = curl_exec($ch);
                    $php_result = json_decode($google_result);

                    if (sizeof($php_result->results) > 0) {
                        foreach ($php_result->results as $r) {
                            $lat = floatval($r->geometry->location->lat);
                            $lon = floatval($r->geometry->location->lng);

                            $location->lat = $lat;
                            $location->lon = $lon;
                            $location->save();
                        }
                    }
                }
            }
        }

        curl_close($ch);
        return response($result, 200)
            ->header('Content-Type', 'text/json');
    }
}
