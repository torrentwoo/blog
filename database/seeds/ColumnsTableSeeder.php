<?php

use Illuminate\Database\Seeder;

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 调用测试数据生成器容器
        $faker     = app(Faker\Generator::class);
        // 设定栏目的父级栏目 id 范围
        $parent_id = range(0, 10);
        // 生成 100 条测试栏目数据
        $columns = factory(App\Models\Column::class)->times(20)->make()->toArray();
        // 保存测试数据到数据库
        App\Models\Column::insert($columns);

        // 无论如何，第一条记录不应该存在父栏目
        $column = App\Models\Column::first();
        $column->update([
            'parent_id' => 0
        ]);
    }
}
