<?php

use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->truncate();
        $boards = array(
            array('board_id'=>1,'name'=>'3D'),
            array('board_id'=>2,'name'=>'Artwork'),
            array('board_id'=>3,'name'=>'Vector'),
            array('board_id'=>11,'name'=>'Forum'),
            array('board_id'=>12,'name'=>'Tutorial'),
            array('board_id'=>13,'name'=>'Q&A')
        );

        DB::table('boards')->insert($boards);
    }
}
