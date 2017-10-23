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
        $arrArticlesId = App\Models\Article::lists('id')->toArray();
        // 为随机的文章分配随机个数的测试附件内容
        foreach ($arrArticlesId as $id) {
            $amount = array_rand(range(0, 3));
            if ($amount > 1) {
                $attachments = factory(App\Models\Attachment::class)->times($amount)->make()->each(function($ele) use ($faker, $id) {
                    $ele->article_id = $id;
                })->toArray();
                App\Models\Attachment::insert($attachments);
            }
        }
    }
}
