<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAddSurfUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surf_user', function(Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->string('surf_id', 100);
            $table->primary('surf_id');
        });

        Schema::table('surf_user', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('surf_attribute', function (Blueprint $table) {
            $table->string('surf_id', 100);
            $table->string('surf_key', 100);
            $table->text('surf_value');

            $table->foreign('surf_id')->references('surf_id')->on('surf_user');
            $table->primary(['surf_id', 'surf_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(){
            $table->dropColumn('surf_id');
        });

        Schema::dropIfExists('surf_attribute');
        Schema::dropIfExists('surf_user');
    }
}
