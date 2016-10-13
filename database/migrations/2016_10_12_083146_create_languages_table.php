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
            $table->integer('language_group_id')->unsigned()->index();
            $table->foreign('language_group_id')->references('id')->on('users');
            $table->string('name',255);
            $table->enum('level',['beginner','advanced','fluent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function(Blueprint $table) {
            $table->dropForeign('users_language_group_id_foreign');
        });
        Schema::drop('languages');
    }
}
