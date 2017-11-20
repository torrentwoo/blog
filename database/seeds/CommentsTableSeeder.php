<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 调用测试数据生成器容器
        $faker = app(Faker\Generator::class);
        // 获取文章的 id
        $arrArticlesId = App\Models\Article::released()->lists('id')->toArray();
        // 获取已激活用户的 id
        $arrUsersId = App\Models\User::activated()->lists('id')->toArray();
        // 生成 100 个测试评论数据
        $comments = factory(App\Models\Comment::class)->times(100)->make()
            ->each(function($ele) use ($faker, $arrUsersId, $arrArticlesId) {
                $ele->user_id = $faker->randomElement($arrUsersId);
                $ele->commentable_id = $faker->randomElement($arrArticlesId);
                $ele->commentable_type = 'App\Models\Article';
            })->toArray();
        // 保存测试数据
        App\Models\Comment::insert($comments);
    }
}
