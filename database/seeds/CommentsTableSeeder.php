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
        // 组装临时数据
        $data = [
            App\Models\Article::class   =>  $arrArticlesId,
            App\Models\Comment::class   =>  range(0, 20),
        ];
        // 生成 100 个测试评论数据
        $comments = factory(App\Models\Comment::class)->times(100)->make()
            ->each(function($ele) use ($faker, $arrUsersId, $data) {
                $model = array_rand($data);
                $ele->user_id = $faker->randomElement($arrUsersId);
                $ele->parent_id = $faker->randomElement($data[$model]); // nested comment
                $ele->commentable_id = $faker->randomElement($data[$model]);
                $ele->commentable_type = $model;
            })->toArray();
        // 保存测试数据
        App\Models\Comment::insert($comments);
    }
}
