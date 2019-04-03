<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MinorLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("minors_locations", function(Blueprint $table) {
            $table->integer("minor_id");
            $table->foreign("minor_id")->references('id')->on('minors');

            $table->unsignedInteger("location_id");
            $table->foreign("location_id")->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("minors_locations");
    }
}
