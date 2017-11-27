<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Invoke Faker via app container
        $faker = app(Faker\Generator::class);
        // Get activated users identifiers
        $users = App\Models\User::activated()->lists('id')->toArray();
        // Get released articles identifiers
        $articles = App\Models\Article::released()->lists('id')->toArray();
        // Generate the testing data
        $likes = factory(App\Models\Like::class)->times(100)->make()->each(function($e) use ($faker, $articles, $users) {
            $e->user_id = $faker->randomElement($users);
            $e->likable_id = $faker->randomElement($articles);
            $e->likable_type = App\Models\Article::class;
        })->toArray();
        // Save the testing data
        App\Models\Like::insert($likes);
    }
}
