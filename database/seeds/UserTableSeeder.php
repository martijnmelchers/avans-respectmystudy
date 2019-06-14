<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all roles
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role_id' => 2,
            'username' => ""
        ]);

        DB::table('users')->insert([
            'name' => 'bedrijf',
            'email' => 'bedrijf@bedrijf.com',
            'password' => Hash::make('bedrijf'),
            'role_id' => 5,
            'username' => ""
        ]);
    }
}
