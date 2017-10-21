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
        // 获取类别的 id
        $categoriesIdArr = App\Models\Category::lists('id')->toArray();
        // 生成 10 篇测试文章内容
        $articles = factory(App\Models\Article::class)->times(10)->make()->each(function($ele) use ($faker, $categoriesIdArr) {
            $ele->category_id = $faker->randomElement($categoriesIdArr);
        });
        // 保存测试数据
        App\Models\Article::insert($articles->toArray());
    }
}
