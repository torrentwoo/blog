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
        $this->call(ColumnsTableSeeder::class); // 生成测试的栏目数据
        $this->call(ArticlesTableSeeder::class); // 生成测试的文章数据
        $this->call(SnapshotsTableSeeder::class); // 生成测试的缩略图数据
        $this->call(TagsTableSeeder::class); // 生成测试的标签数据
        $this->call(CommentsTableSeeder::class); // 生成测试的评论数据

        $this->call(FavoritesTableSeeder::class); // 生成测试的收藏数据
        $this->call(LikesTableSeeder::class); // 生成测试的喜欢数据
        $this->call(FollowsTableSeeder::class); // 生成测试的关注数据

        Model::reguard();
    }
}
