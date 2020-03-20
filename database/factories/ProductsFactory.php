<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'short_description' => $faker->text($maxNbChars = 200),
        'description' => $faker->paragraph($nb = 3, $asText = false),  
        'active' => 1,
        'feature' => 1,
        'type' => 'simple',
        'feature_image'=>'',
        'price' => '10000000',
        'sale_price' => 0,
        'seo_title' => $faker->sentence,
        'meta_keyword' => $faker->text($maxNbChars = 20),
        'meta_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
