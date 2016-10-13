<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $countries = array(
        );
        DB::table('countries')->insert($countries);
    }
}
