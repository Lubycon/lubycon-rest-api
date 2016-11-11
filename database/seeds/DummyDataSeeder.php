<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate(); run this code in admin seeder
        factory(App\User::class, 100)->create();

        DB::table('posts')->truncate();
        factory(App\Post::class, 100)->create();

        DB::table('comments')->truncate();
        factory(App\Comment::class, 300)->create();

        DB::table('contents')->truncate();
        factory(App\Content::class, 100)->create();

        DB::table('content_category_kernels')->truncate();
        factory(App\Comment::class, 500)->create();

        DB::table('content_tags')->truncate();
        factory(App\Comment::class, 500)->create();
    }
}
