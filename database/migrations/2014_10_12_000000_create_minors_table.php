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
            $table->integer('id');
            $table->double('version', 8, 2);

            $table->string('name', '45');
            $table->string('phonenumber', '45');
            $table->string('email', '45');
            $table->integer('kiesopmaat');
            $table->string('place', '45');
            $table->double('ects', 8, 2);
            $table->text('subject');
            $table->text('goals');
            $table->text('requirements');
            $table->text('examination');
            $table->double('contact_hours', 8, 2)->nullable();
            $table->integer('costs')->nullable();
            $table->string('level', '45');
            $table->string('education_type', '45')->nullable();
            $table->string('language', '45');
            $table->text('extra_information')->nullable();
            $table->tinyInteger('is_published');
            $table->tinyInteger('is_enrollable');
            $table->unsignedInteger('organisation_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('education_period_id');
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('education_period_id')->references('id')->on('education_periods');

            $table->primary(["id", "version"]);
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
