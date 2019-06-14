<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_groups', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("organisation_id")->nullable();

            $table->string("name");
            $table->string("description");
            $table->boolean("is_public");

            $table->string("email");
            $table->string("telephone");
            $table->string("postaladdress");

            $table->timestamps();

            $table->foreign("organisation_id")->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_groups');
    }
}
