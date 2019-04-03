<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('media_type_id');
            $table->integer('minor_id');
            $table->integer('newsitem_id')->nullable();
            $table->string('media_link', 'max:250')->nullable();
            $table->timestamps();

            $table->foreign('media_type_id')->references('id')->on('media_types');
            $table->foreign('minor_id')->references('id')->on('minors');
            $table->foreign('newsitem_id')->references('id')->on('newsitems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
