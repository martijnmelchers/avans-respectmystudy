<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('name', 'max:100');
            $table->tinyInteger('primarylocation');
            $table->integer('establishment');
            $table->string('mailaddress', 'max:45');
            $table->string('mailzip', 'max:15');
            $table->string('mailcity', 'max:100');
            $table->string('visitingaddress', 'max:100');
            $table->string('visitingzip', 'max:15');
            $table->string('visitingcity', 'max:100');
            $table->integer('organisation_id')->unique();

            $table->foreign('organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
