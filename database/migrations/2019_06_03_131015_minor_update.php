<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MinorUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minors', function (Blueprint $table) {
            $table->string('organisation_id', 10)->nullable()->change();
            $table->integer('kiesopmaat')->nullable()->change();
            $table->dropColumn('phonenumber');
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minors', function (Blueprint $table) {
            $table->string('organisation_id', 10)->nullable(false)->change();
            $table->integer('kiesopmaat')->nullable(false)->change();
            $table->string('phonenumber', 16);
            $table->string('email', 100);
        });
    }
}
