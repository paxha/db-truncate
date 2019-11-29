<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use DBTruncate\Tests\Models\User;
use Faker\Generator as Faker;
use DBTruncate\Tests\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->realText(10),
        'body' => $faker->realText(100),
    ];
});
