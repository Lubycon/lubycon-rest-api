<?php

use Illuminate\Database\Seeder;

class DummyPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        factory(App\User::class, 100)->create();

        DB::table('posts')->truncate();
        factory(App\post::class, 100)->create();
    }
}
