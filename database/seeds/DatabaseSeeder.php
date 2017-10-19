<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class); // 生成测试用户（账号）数据
        $this->call(CategoriesTableSeeder::class); // 生成测试的类别数据

        Model::reguard();
    }
}
