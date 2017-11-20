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
        $beFollowed = array_slice($users, (int) count($users) / 2);
        // 获取公开的栏目 id
        $columns = App\Models\Column::visible()->lists('id')->toArray();
        // 组装临时数据
        $tmp = [
            'App\Models\User'   =>  array_diff($users, $beFollowed),
            'App\Models\Column' =>  $columns,
        ];
        // 生成 100 个测试的关注数据
        $follows = factory(App\Models\Follow::class)->times(count($tmp['App\Models\User']))->make()->each(function($ele) use ($faker, $beFollowed, $tmp) {
            $model = array_rand($tmp);
            $ele->user_id = $faker->randomElement($beFollowed);
            $ele->followable_id = $faker->randomElement($tmp[$model]);
            $ele->followable_type = $model;
        })->toArray();
        App\Models\Follow::insert($follows);
    }
}
