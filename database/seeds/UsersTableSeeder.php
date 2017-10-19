<?php

use Illuminate\Database\Seeder;

use App\Models\User; // import user model
use Illuminate\Support\Facades\Hash; // import hash facade

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
        $users = factory(User::class)->times(10)->make();
        User::insert($users->toArray());

        // 修改第一个用户信息（以便登录测试）
        $user  = User::find(1);
        $user->name     = 'torrent';
        $user->email    = 'torrent@devel.local';
        $user->password = Hash::make('test');
        $user->activated= true;
        $user->save();
    }
}
