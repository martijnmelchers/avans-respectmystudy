<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('email', 'max:45')->unique();
            $table->string('phonenumber', 'max:15');
            $table->string('zipcode');
            $table->integer('housenumber');
            $table->string('firstname', 'max:45');
            $table->string('infix', 'max:25');
            $table->string('surname', 'max:45');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_informations');
    }
}
