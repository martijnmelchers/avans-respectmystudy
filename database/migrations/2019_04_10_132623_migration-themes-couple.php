<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationThemesCouple extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minors_themes', function (Blueprint $table) {
            $table->integer('minor_id');
            $table->string('theme_id');

            $table->primary(['minor_id', 'theme_id']);

            $table->foreign('minor_id')->references('id')->on('minors');
            $table->foreign('theme_id')->references('id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minors_themes');
    }
}
