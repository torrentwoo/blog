<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index(); // 属于谁，关联至用户表 id
            // 基本属性
            $table->string('douban')->nullable(); // 豆瓣的个人主页
            $table->string('facebook')->nullable(); // Facebook 个人主页
            $table->string('linkedin')->nullable(); // 领英个人主页
            $table->string('qq')->nullable(); // QQ 号码
            $table->string('twitter')->nullable(); // 推特个人主页
            $table->string('weibo')->nullable(); // 微博的个人主页
            $table->string('weixin')->nullable(); // 微信个人二维码（图片，需要上传保存）的存储地址
            // 扩展属性
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('socials');
    }
}
