<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string("tag");

            $table->timestamps();
        });

        Schema::create('minors_tags', function (Blueprint $table) {
            $table->integer("minor_id");
            $table->integer('tag_id');

            $table->primary(['minor_id', 'tag_id']);

            $table->foreign('minor_id')->references('id')->on('minors');
            $table->foreign('tag_id')->references('id')->on('tags');

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
        Schema::dropIfExists('tags');
        Schema::dropIfExists('minors_tags');
    }
}
