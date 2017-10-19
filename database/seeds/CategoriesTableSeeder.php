<?php

use Illuminate\Database\Seeder;

use App\Models\Category; // import category model

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成100条测试类别数据
        // 注：并不会填充 parent_id 字段 @TODO
        $faker      = app(Faker\Generator::class);
        $parent_id  = range(0, 50);
        $categories = factory(Category::class)->times(100)->make()->each(function($i) use ($faker, $parent_id) {
            $i->parent_id = $faker->randomElement($parent_id);
        });
        Category::insert($categories->toArray());
        // 无论如何，第一条记录不应该存在父分类
        $category   = Category::first();
        $category->update([
            'parent_id' => 0
        ]);
    }
}
