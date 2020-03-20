<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Posts;
use Faker\Generator as Faker;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,20),
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'short_description' => $faker->text($maxNbChars = 200),
        'description' => $faker->paragraph($nb = 3, $asText = false),  
        'active' => 1,
        'feature' => 1,
        'type' => 'post',
        'feature_image'=>'',
        'seo_title' => $faker->sentence,
        'meta_keyword' => $faker->text($maxNbChars = 20),
        'meta_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
