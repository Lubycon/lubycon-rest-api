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
            array('board_id'=>1,'name'=>'3D','group'=>'content'),
            array('board_id'=>2,'name'=>'Artwork','group'=>'content'),
            array('board_id'=>3,'name'=>'Vector','group'=>'content'),
            array('board_id'=>11,'name'=>'Forum','group'=>'post'),
            array('board_id'=>12,'name'=>'Tutorial','group'=>'post'),
            array('board_id'=>13,'name'=>'Q&A','group'=>'post')
        );

        DB::table('boards')->insert($boards);
    }
}
