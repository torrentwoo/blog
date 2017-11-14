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
        $articlesIdArr = App\Models\Article::released()->lists('id')->toArray();
        // 获取用户的 id
        $usersIdArr = App\Models\User::lists('id')->toArray();
        // 生成 100 个测试评论数据
        $comments = factory(App\Models\Comment::class)->times(100)->make()->each(function($ele) use ($faker, $usersIdArr, $articlesIdArr) {
            $ele->user_id = $faker->randomElement($usersIdArr);
            $ele->article_id = $faker->randomElement($articlesIdArr);
        });
        App\Models\Comment::insert($comments->toArray());
    }
}
