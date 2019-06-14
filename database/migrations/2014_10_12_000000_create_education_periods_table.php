<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('enroll_start');
            $table->dateTime('enroll_end');
            $table->string('organisation_id', 10)->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('education_periods');
    }
}
