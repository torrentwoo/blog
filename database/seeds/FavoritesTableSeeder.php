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
        $arrUsersId = App\Models\User::activated()->lists('id')->toArray();
        // 获取已批准发布的所有文章 id
        $arrArticlesId = App\Models\Article::released()->lists('id')->toArray();
        // 生成 100 个测试的收藏数据
        $favorites = factory(App\Models\Favorite::class)->times(count($arrArticlesId))->make()
            ->each(function($ele) use ($faker, $arrUsersId, $arrArticlesId) {
                $ele->user_id = $faker->randomElement($arrUsersId);
                $ele->favorable_id = $faker->randomElement($arrArticlesId);
                $ele->favorable_type = 'App\Models\Article';
            })->toArray();
        // 保存测试数据
        App\Models\Favorite::insert($favorites);
    }
}
