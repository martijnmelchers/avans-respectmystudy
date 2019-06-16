<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinorLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minor_like', function (Blueprint $table) {

            $table->timestamps();

            $table->unsignedInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('minor_id');
            $table->foreign('minor_id')->references('id')->on('minors');



            $table->primary(['user_id','minor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minor_like');
    }
}
