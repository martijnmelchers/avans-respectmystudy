<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MinorEducationperiods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("minors_educationperiods", function(Blueprint $table) {
            $table->integer("minor_id");
            $table->foreign("minor_id")->references('id')->on('minors');

            $table->unsignedInteger("education_period_id");
            $table->foreign("education_period_id")->references('id')->on('education_periods');
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
