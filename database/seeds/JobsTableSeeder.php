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
            array('name'=>'Artist'),
            array('name'=>'Designer'),
            array('name'=>'Developer'),
            array('name'=>'Student'),
            array('name'=>'Others'),
        );

        DB::table('jobs')->insert($jobs);
    }
}
