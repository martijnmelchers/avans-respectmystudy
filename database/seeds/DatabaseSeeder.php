<?php

use App\Location;
use App\Minor;
use App\Organisation;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Minor::query()->delete();
        Location::query()->delete();
        Organisation::query()->delete();
        \App\EducationPeriod::query()->delete();

        $faker = new Faker();

        $org = new Organisation([
            "id" => 1,
            "name" => "WordQuest",
            "email" => "help@wordquest.nl",
            "phonenumber" => "06123456789",
            "location" => "Veldhoven"
        ]);
        $org->save();

        $location = new Location([
            "id" => 1,
            "name" => "Onderwijsboulevard",
            "primarylocation" => 1,
            "establishment" => 1,
            "mailaddress" => "teststraat",
            "mailzip" => "0000",
            "mailcity" => "veldhoven",
            "visitingaddress" => "schans",
            "visitingzip" => "BOE",
            "visitingcity" => "veldhoven",
            "organisation_id" => 1
        ]);
        $location->save();

        $period = new \App\EducationPeriod(["id"=>1, "name"=>"Najaar 2019", "begin"=>"2019-08-20", "end"=>"2019-12-20"]);
        $period->save();

        $this->call(MinorTableSeeder::class);
    }
}
