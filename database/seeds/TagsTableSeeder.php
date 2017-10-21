<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成 20 条测试标签
        $tags = factory(App\Models\Tag::class)->times(20)->make();
        // 保存测试标签数据
        App\Models\Tag::insert($tags->toArray());

        // 调用测试数据生成器容器
        $faker = app(Faker\Generator::class);
        // 获取已创建标签的 id
        $tagsIdArr = App\Models\Tag::lists('id')->toArray();
        // 获取已发布文章的 id
        $articlesIdArr = App\Models\Article::lists('id')->toArray(); // 以文章的数量为准
        if (!empty($articlesIdArr) && !empty($tagsIdArr)) {
            $data = [];
            foreach ($articlesIdArr as $article_id) {
                $data[] = array(
                    'tag_id'    =>  $faker->randomElement($tagsIdArr),
                    'article_id'=>  $article_id,
                );
            }
            // 保存标签与文章之间的映射关系
            DB::table('tag_clouds')->insert($data);
        }
    }
}
