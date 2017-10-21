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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),

        'created_at'     =>  $faker->dateTime,
        'updated_at'     =>  $faker->dateTime,
        'activated'      =>  false,
    ];
});

// Testing data for category
$factory->define(App\Models\Category::class, function(Faker\Generator $faker) {
    return [
        'name'          =>  $faker->word,
        'description'   =>  $faker->sentence,
        'priority'      =>  $faker->randomElement(range(0, 10)),
        'hidden'        =>  false,
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for articles
$factory->define(App\Models\Article::class, function(Faker\Generator $faker) {
    return [
        'title'         =>  $faker->sentence,
        'keywords'      =>  implode(',', $faker->words),
        'description'   =>  $faker->sentence,
        'content'       =>  $faker->text,
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for comments
$factory->define(App\Models\Comment::class, function(Faker\Generator $faker) {
    return [
        'content'       =>  $faker->sentence,
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for tags
$factory->define(App\Models\Tag::class, function(Faker\Generator $faker) {
    $tmp = $faker->word;
    return [
        'name'      =>  $tmp,
        'rewrite'   =>  $tmp,
    ];
});
