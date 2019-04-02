<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsitems', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('user_id')->unique();
            $table->longText('description');
            $table->date('publishing_date');
            $table->timestamps();
            $table->foreign('id')->references('newsitem_id')->on('media');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsitems');
    }
}
