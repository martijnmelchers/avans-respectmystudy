<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minors', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('minor_name', 'max:45');
            $table->double('version', 8, 2);
            $table->string('phonenumber', 'max:45');
            $table->string('email', 'max:45');
            $table->integer('kiesopmaat');
            $table->string('place', 'max:45');
            $table->timestamp('created');
            $table->timestamp('modified');
            $table->double('ects', 8, 2);
            $table->text('subject');
            $table->text('goals');
            $table->text('requirements');
            $table->text('examination');
            $table->double('contact_hours', 8, 2)->nullable();
            $table->integer('costs')->nullable();
            $table->string('level', 'max:45');
            $table->string('education_type', 'max:45')->nullable();
            $table->string('language', 'max:45');
            $table->text('extra_information')->nullable();
            $table->tinyInteger('is_published');
            $table->tinyInteger('is_enrollable');
            $table->integer('organisation_id')->unique();
            $table->integer('location_id')->unique();
            $table->integer('education_period_id')->unique();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('education_period_id')->references('id')->on('education_periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minors');
    }
}
