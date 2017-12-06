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

        // 修改前两个用户信息（以便测试及交互）
        $a = App\Models\User::find(1);
        $a->name     = 'torrent';
        $a->email    = 'gobacker@163.com';
        $a->password = bcrypt('test');
        $a->activated= true;
        $a->save();

        $a = App\Models\User::find(2);
        $a->name     = 'slash';
        $a->email    = 'slash@devel.local';
        $a->password = bcrypt('test');
        $a->activated= true;
        $a->save();
    }
}
