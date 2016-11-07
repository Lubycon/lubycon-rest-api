<?php

use Illuminate\Database\Seeder;

class LicenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licenses')->truncate();
        $licenses = array(
            array("id" => 1 ,"name"=> "Free" , "url"=> "http://creativecommons.org/licenses/by/4.0" , "icon" => "", "description" => "Copy and redistribute the material in any medium or format, remix, transform, and build upon the material for any purpose, even commercially."),
            array("id" => 2 ,"name"=> "Non-Commercial" , "url"=> "http://creativecommons.org/licenses/by-nc/4.0" , "icon" => "", "description" => "Copy and redistribute the material in any medium or format remix, transform, and build upon the material"),
            array("id" => 3 ,"name"=> "Non-Derivative" , "url"=> "http://creativecommons.org/licenses/by-nc-nd/4.0" , "icon" => "", "description" => " Copy and redistribute the material in any medium or formatThe licensor cannot revoke these freedoms as long as you follow the license terms."),
            array("id" => 4 ,"name"=> "Non-Derivative" , "url"=> "http://creativecommons.org/licenses/by-nc-sa/4.0" , "icon" => "", "description" => "Copy and redistribute the material in any medium or format remix, transform, and build upon the material."),
            array("id" => 5 ,"name"=> "Non-Derivative" , "url"=> "http://creativecommons.org/licenses/by-nd/4.0" , "icon" => "", "description" => "Copy and redistribute the material in any medium or format for any purpose, even commercially. The licensor cannot revoke these freedoms as long as you follow the license terms."),
        );

        DB::table('licenses')->insert($licenses);
    }
}
