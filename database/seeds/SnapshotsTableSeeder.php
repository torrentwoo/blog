<?php

use Illuminate\Database\Seeder;

class SnapshotsTableSeeder extends Seeder
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
        // 获取已发布文章的 id 数据
        $arrArticlesId = App\Models\Article::lists('id')->toArray();
        // 为每篇文章分配一个缩略图
        $data = [];
        foreach ($arrArticlesId as $id) {
            $thumbnails = factory(App\Models\Snapshot::class)->make()->toArray();
            $data[] = array_merge($thumbnails, [
                'snapshotable_id'   =>  $id,
                'snapshotable_type' =>  'App\Models\Article',
            ]);
        }
        empty($data) !== true && App\Models\Snapshot::insert($data);
    }
}
