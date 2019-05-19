<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoupleContactsTeachersMinors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minors_contact_persons', function (Blueprint $table) {
            $table->integer('minor_id');
            $table->string('contact_person_id');

            $table->foreign('minor_id')->references('id')->on('minors');
            $table->foreign('contact_person_id')->references('id')->on('contact_people');
        });

        Schema::table('minors', function(Blueprint $table) {
            $table->string('contact_group_id')->nullable();
            $table->foreign('contact_group_id')->references('id')->on('contact_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minors_contact_persons');

        Schema::table('minors', function(Blueprint $table) {
            $table->dropColumn('contact_group_id');
        });
    }
}
