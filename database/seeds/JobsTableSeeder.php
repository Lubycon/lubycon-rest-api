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
        DB::table('jobs')->truncate();
        $jobs = array(
            array('job_id'=>1,'name'=>'Artist'),
            array('job_id'=>2,'name'=>'Designer'),
            array('job_id'=>3,'name'=>'Developer'),
            array('job_id'=>4,'name'=>'Student'),
            array('job_id'=>5,'name'=>'Others'),
        );

        DB::table('jobs')->insert($jobs);
    }
}
