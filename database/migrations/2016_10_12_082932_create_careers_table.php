<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('career_group_id');
            $table->string('location',255);
            $table->dateTime('date');
            $table->enum('category',['work_experience','education','awards']);
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('career_group_id')->references('career_group_id')->on('careers');
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
            $table->dropForeign('users_career_group_id_foreign');
        });
        Schema::drop('careers');
    }
}
