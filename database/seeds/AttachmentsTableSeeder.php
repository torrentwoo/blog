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
        // 为每篇文章分配一个测试（图片）附件，该附件的 preview 字段属性为真
        $data = [];
        foreach ($arrArticlesId as $id) {
            $attachments = factory(App\Models\Attachment::class)->make()->toArray();
            $data[] = array_merge($attachments, [
                'article_id'    =>  $id,
                'preview'       =>  true,
            ]);
        }
        empty($data) !== true && App\Models\Attachment::insert($data);
    }
}
