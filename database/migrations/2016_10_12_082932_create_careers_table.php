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
            $table->integer('user_id')->unsigned()->index();
            $table->string('location',255);
            $table->dateTime('date');
            $table->enum('category',['work_experience','education','awards']);
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('id')->references('user_id')->on('careers');
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
            $table->dropForeign('users_id_foreign');
        });
        Schema::drop('careers');
    }
}
