<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('role_id')->unique();
            $table->integer('minor_id')->nullable();
            $table->string('username', 'max:45');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 'max:100');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('personal_informations');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('minor_id')->references('id')->on('minors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
