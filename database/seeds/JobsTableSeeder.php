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
            array('id'=>1,'name'=>'Artist'),
            array('id'=>2,'name'=>'Designer'),
            array('id'=>3,'name'=>'Developer'),
            array('id'=>4,'name'=>'Student'),
            array('id'=>5,'name'=>'Others'),
        );

        DB::table('jobs')->insert($jobs);
    }
}
