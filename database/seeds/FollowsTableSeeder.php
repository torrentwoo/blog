<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 以容器方式调用 Faker
        $faker = app(Faker\Generator::class);
        // 获取已激活的用户 id
        $users = App\Models\User::activated()->lists('id')->toArray();
        // 获取公开的栏目 id
        $columns = App\Models\Column::visible()->lists('id')->toArray();
        // 组装临时数据
        $data = [
            App\Models\User::class   =>  $users,
            App\Models\Column::class =>  $columns,
        ];
        // 生成 100 个测试的关注数据
        $follows = factory(App\Models\Follow::class)->times(100)->make()->each(function($ele) use ($faker, $data) {
            $model = array_rand($data);
            $ele->user_id = $faker->randomElement($data[App\Models\User::class]);
            $ele->followable_id = $faker->randomElement($data[$model]);
            $ele->followable_type = $model;
        })->toArray();
        App\Models\Follow::insert($follows);
        // 删除自己关注自己的数据
        DB::delete("DELETE FROM `follows` WHERE `user_id` = `followable_id` AND `followable_type` LIKE '%User'");
    }
}
