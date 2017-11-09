<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 调用测试数据生成器容器
        $faker      = app(Faker\Generator::class);
        // 设定类别的父级分类 id 范围
        $parent_id  = range(0, 10);
        // 生成 100 条测试类别数据
        $categories = factory(App\Models\Category::class)->times(20)->make()->each(function($i) use ($faker, $parent_id) {
            $i->parent_id = $faker->randomElement($parent_id);
        });
        // 保存测试数据到数据库
        App\Models\Category::insert($categories->toArray());

        // 无论如何，第一条记录不应该存在父分类
        $category   = App\Models\Category::first();
        $category->update([
            'parent_id' => 0
        ]);
    }
}
