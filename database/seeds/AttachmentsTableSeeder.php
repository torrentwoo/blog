<?php

use Illuminate\Database\Seeder;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 以容器的方式调用测试数据生成器
        $faker = app(Faker\Generator::class);
        // 获取已发布文章的 id
        $articlesIdArr = App\Models\Article::lists('id')->toArray();
        // 为每篇文章随机分配 0 到 3 个测试的附件内容
        foreach ($articlesIdArr as $id) {
            $amount = array_rand(range(0, 3));
            if ($amount > 0) {
                $attachments = factory(App\Models\Attachment::class)->times($amount)->make()->each(function($ele) use ($faker, $id) {
                    $ele->article_id = $id;
                })->toArray();
                App\Models\Attachment::insert($attachments);
            }
        }
    }
}
