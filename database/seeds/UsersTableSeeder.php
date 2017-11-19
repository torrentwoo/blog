<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 以容器方式调用 Faker\Generator
        $faker = app(Faker\Generator::class);
        // 生成10个测试用户数据
        $users = factory(App\Models\User::class)->times(20)->make()->each(function($user) use ($faker) {
            $user->activated = $faker->randomElement([false, true]);
        })->toArray();
        App\Models\User::insert($users);

        // 修改第一个用户信息（以便登录测试）
        $user  = App\Models\User::find(1);
        $user->name     = 'torrent';
        $user->email    = 'gobacker@163.com';
        $user->password = bcrypt('test');
        $user->activated= true;
        $user->save();
    }
}
