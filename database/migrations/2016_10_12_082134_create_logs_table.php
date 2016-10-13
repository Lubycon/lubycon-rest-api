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
            $table->integer('logs_group_id')->unsigned()->index();
            $table->foreign('logs_group_id')->references('id')->on('users');
            $table->string('ip',255);
            $table->dateTime('date');
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
        Schema::table('logs', function(Blueprint $table) {
            $table->dropForeign('users_logs_group_id_foreign');
        });
        Schema::drop('logs');
    }
}
