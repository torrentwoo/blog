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
        // Get released articles identifiers
        $arrArticlesId = App\Models\Article::lists('id')->toArray();
        // Get activated users identifiers
        $arrUsersId = App\Models\User::lists('id')->toArray();
        // Prepare the temporary data for faker
        $data = [
            'users'     =>  $arrUsersId,
            'articles'  =>  $arrArticlesId,
        ];
        // Generate the testing data
        $likes = factory(App\Models\Like::class)->times(100)->make()->each(function($e) use ($faker, $data) {
            $e->user_id = $faker->randomElement($data['users']);
            $e->likable_id = $faker->randomElement($data['articles']);
            $e->likable_type = 'App\Models\Article';
        })->toArray();
        // Save the testing data
        App\Models\Like::insert($likes);
    }
}
