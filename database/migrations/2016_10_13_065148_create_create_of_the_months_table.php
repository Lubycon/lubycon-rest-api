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
            $table->integer('create_of_the_months_group_id')->unsigned()->index();
            $table->foreign('create_of_the_months_group_id')->references('id')->on('users');
            $table->date('date');
            $table->string('introduce',255);
            $table->text('interview_url');
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
        Schema::table('create_of_the_months', function(Blueprint $table) {
            $table->dropForeign('users_create_of_the_months_group_id_foreign');
        });
        Schema::drop('create_of_the_months');
    }
}
