<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_group_id');
            $table->string('name',255);
            $table->enum('level',['beginner','advanced','fluent']);
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('language_group_id')->references('language_group_id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_language_group_id_foreign');
        });
        Schema::drop('languages');
    }
}
