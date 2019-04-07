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
            $table->increments('id');
            $table->string('name', '100');
            $table->tinyInteger('primarylocation');
            $table->integer('establishment');
            $table->string('mailaddress', '45');
            $table->string('mailzip', '15');
            $table->string('mailcity', '100');
            $table->string('visitingaddress', 100);
            $table->string('visitingzip', '15');
            $table->string('visitingcity', '100');
            $table->string('organisation_id', 10);
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations');
//            $table->foreign('organisation_id')->
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
