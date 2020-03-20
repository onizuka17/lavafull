<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product_taxonomy;
use Faker\Generator as Faker;

$factory->define(Product_taxonomy::class, function (Faker $faker) {
    return [
    	'parent_id' => 0,
        'title' => $faker->sentence,
        'slug' => $faker->slug,
        'description' => $faker->paragraph($nb = 3, $asText = false),  
        'type' => 'category',
        'seo_title' => $faker->sentence,
        'meta_keyword' => $faker->text($maxNbChars = 20),
        'meta_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
