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
        factory(App\Post::class, 100)->create();

        DB::table('comments')->truncate();
        factory(App\Comment::class, 300)->create();
    }
}
