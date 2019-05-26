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
        // Delete all roles
        DB::table('roles')->delete();

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
    }
}
