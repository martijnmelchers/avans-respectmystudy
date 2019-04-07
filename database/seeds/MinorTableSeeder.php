<?php

use Illuminate\Database\Seeder;

class MinorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Minor::class, 10)->create();
    }
}
