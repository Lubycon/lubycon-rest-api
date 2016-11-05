<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'job' => mt_rand(1,5),
        'country' => mt_rand(1,250),
        'is_active' => 'active',
        'is_accept_terms' => '111',
    ];
});

$factory->define(App\post::class, function (Faker\Generator $faker) {
    return [
        'board' => 1,
        'user_id' => mt_rand(1,100),
        'title' => $faker->name,
        'content' => str_random(10),
        'directory' => 'path',
        "comment_count" => mt_rand(0,100),
        "like_count" => mt_rand(0,100),
        "view_count" => mt_rand(0,100),
        "created_at" => date("Y-m-d H:i:s",rand(1262055681,1478304000)),
    ];
});

$factory->define(App\comment::class, function (Faker\Generator $faker) {
    return [
        'give_user_id' => mt_rand(1,100),
        'take_user_id' => mt_rand(1,100),
        'board' => mt_rand(0,1) ? 1 : 11,
        'post_id' => mt_rand(0,100),
        "content" => str_random(10),
        "created_at" => date("Y-m-d H:i:s",rand(1262055681,1478304000)),
    ];
});
