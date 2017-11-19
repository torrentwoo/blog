<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 以容器方式调用 Faker
        $faker = app(Faker\Generator::class);
        // 获取已激活的用户 id
        $usersIdArr = App\Models\User::activated()->lists('id')->toArray();
        // 获取已批准发布的所有文章 id
        $articlesIdArr = App\Models\Article::released()->lists('id')->toArray();
        // 生成 100 个测试的收藏数据
        $favorites = factory(App\Models\Favorite::class)->times(100)->make()->each(function($ele) use ($faker, $usersIdArr, $articlesIdArr) {
            $ele->user_id = $faker->randomElement($usersIdArr);
            $ele->favorable_id = $faker->randomElement($articlesIdArr);
            $ele->favorable_type = 'App\Models\Article';
        })->toArray();
        App\Models\Favorite::insert($favorites);
    }
}
