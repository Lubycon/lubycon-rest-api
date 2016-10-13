<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('job_id')->unsigned();
            $table->string('occupation',255);
            $table->timestamps();
        });

        $data = array(
            array('occupation'=>'Artist'),
            array('occupation'=>'Designer'),
            array('occupation'=>'Developer'),
            array('occupation'=>'Student'),
            array('occupation'=>'Others'),
        );

        \App\job::insert($data); // Eloquent
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
