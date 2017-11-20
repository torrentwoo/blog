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
        $authors = App\Models\User::activated()->lists('id')->toArray();
        // 获取栏目的 id
        $columns = App\Models\Column::visible()->lists('id')->toArray();
        // 生成 100 篇测试文章内容
        $articles = factory(App\Models\Article::class)->times(100)->make()->each(function($ele) use ($faker, $authors, $columns) {
            $ele->user_id = $faker->randomElement($authors);
            $ele->column_id = $faker->randomElement($columns);
        });
        // 保存测试数据
        App\Models\Article::insert($articles->toArray());
    }
}
