<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateOfTheMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_of_the_months', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->date('date');
            $table->string('introduce',255);
            $table->text('interview_url');
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('id')->references('users_id')->on('create_of_the_months');
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
        Schema::drop('create_of_the_months');
    }
}
