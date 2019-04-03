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
            $table->increments('id')->primary();
            $table->text('description');
            $table->timestamp('date_placed');
            $table->integer('minor_id')->unique();
            $table->integer('user_id')->unique();
            $table->integer('grade_quality', 8, 2);
            $table->integer('grade_studiability', 8, 2);
            $table->integer('grade_content', 8, 2);
            $table->text('comment')->nullable();

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
