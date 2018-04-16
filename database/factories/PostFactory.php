<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'creator_id' => 1,
        'subreddit_id' => 1,
        'slug' => str_slug($faker->words(2, true)),
        'body' => $faker->paragraphs(rand(2,4), true),
    ];
});
