<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        // 获取作者的 id
        $authors = App\Models\User::lists('id')->toArray();
        // 获取类别的 id
        $categories = App\Models\Category::lists('id')->toArray();
        // 生成 100 篇测试文章内容
        $articles = factory(App\Models\Article::class)->times(100)->make()->each(function($ele) use ($faker, $authors, $categories) {
            $ele->user_id = $faker->randomElement($authors);
            $ele->category_id = $faker->randomElement($categories);
        });
        // 保存测试数据
        App\Models\Article::insert($articles->toArray());
    }
}
