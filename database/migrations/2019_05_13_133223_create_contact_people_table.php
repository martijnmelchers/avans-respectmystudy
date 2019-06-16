<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_people', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("organisation_id")->nullable();

            $table->string("firstname");
            $table->string("middlename")->nullable();
            $table->string("lastname");
            $table->string("email");

            $table->timestamps();

            $table->foreign("organisation_id")->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_people');
    }
}
