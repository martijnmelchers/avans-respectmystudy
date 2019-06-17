<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'role_name' => "default",
            'role_description' => 'standaard rol',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => "admin",
            'role_description' => 'administrator rol',
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'role_name' => "Student",
            'role_description' => 'Student rol',
        ]);

        DB::table('roles')->insert([
            'id' => 5,
            'role_name' => "Bedrijf",
            'role_description' => 'Bedrijf rol',
        ]);

        DB::table('roles')->insert([
            'id' => 6,
            'role_name' => "Assessor",
            'role_description' => 'Assessor rol',
        ]);

        DB::table('roles')->insert([
            'id' => 7,
            'role_name' => "Hoofdassessor",
            'role_description' => 'Hoofdassessor rol',
        ]);
    }
}
