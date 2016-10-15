<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->delete();
        $jobs = array(
            array('occupation'=>'Artist'),
            array('occupation'=>'Designer'),
            array('occupation'=>'Developer'),
            array('occupation'=>'Student'),
            array('occupation'=>'Others'),
        );

        DB::table('jobs')->insert($jobs);
    }
}
