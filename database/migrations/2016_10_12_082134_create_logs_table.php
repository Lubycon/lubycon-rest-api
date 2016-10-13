<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('log_group_id')->unsigned()->nullable();
            $table->string('ip',255);
            $table->dateTime('date');
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('log_group_id')->references('log_group_id')->on('logs');
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
            $table->dropForeign('users_log_group_id_foreign');
        });
        Schema::drop('logs');
    }
}
