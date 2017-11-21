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

// Testing data for column
$factory->define(App\Models\Column::class, function(Faker\Generator $faker) {
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
        'description'   =>  $faker->text(200),
        'content'       =>  $faker->text($faker->numberBetween(800, 1000)),
        'approval'      =>  $faker->boolean,
        'released_at'   =>  date('Y-m-d', strtotime('-' . array_rand(range(1, 30)) . ' day')),
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for snapshots
$factory->define(App\Models\Snapshot::class, function(Faker\Generator $faker) {
    return [
        'loc'           =>  null,
        'url'           =>  $faker->imageUrl(150, 150),
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

// Testing data for favorites
$factory->define(App\Models\Favorite::class, function(Faker\Generator $faker) {
    return [
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for likes
$factory->define(App\Models\Like::class, function(Faker\Generator $faker) {
    return [
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});

// Testing data for follows
$factory->define(App\Models\Follow::class, function(Faker\Generator $faker) {
    return [
        'created_at'    =>  $faker->dateTime,
        'updated_at'    =>  $faker->dateTime,
    ];
});
