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
        // 生成10个测试用户数据
        $users = factory(App\Models\User::class)->times(10)->make();
        App\Models\User::insert($users->toArray());

        // 修改第一个用户信息（以便登录测试）
        $user  = App\Models\User::find(1);
        $user->name     = 'torrent';
        $user->email    = 'torrent@devel.local';
        $user->password = bcrypt('test');
        $user->activated= true;
        $user->save();
    }
}
