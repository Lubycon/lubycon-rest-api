<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountryTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
        $this->call(DummyPostSeeder::class);
        $this->call(PostSortTableSeeder::class);
        $this->call(ContentSortTableSeeder::class);
        $this->call(ContentCategoryTableSeeder::class);

        Model::reguard();
    }
}
