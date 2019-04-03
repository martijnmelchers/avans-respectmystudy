<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('minor_id');
            $table->unsignedInteger('user_id');
            $table->float('grade_quality', 8, 2);
            $table->float('grade_studiability', 8, 2);
            $table->float('grade_content', 8, 2);
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('minor_id')->references('id')->on('minors');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
