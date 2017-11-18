<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // 基础属性
            $table->string('name'); // 用户名（登录凭证）
            // While database charset been set to utf8mb4, collation been set to utf8mb4_unicode_ci
            // Then MUST set this email field a explicit length to 191, avoid unique key too long error: SQLSTATE[42000]
            $table->string('email', 191)->unique(); // 注册邮箱（登录凭证）
            $table->string('password', 60); // 登录密码（登录凭证）
            // 扩展属性
            $table->enum('gender', ['male', 'female', 'secret'])->default('secret'); // 性别
            $table->string('location')->nullable(); // 所在地（取城市）
            $table->string('nickname')->nullable(); // 个人昵称（唯一）
            $table->string('avatar')->nullable(); // 个人头像
            $table->string('introduction')->nullable(); // 个人简介
            $table->boolean('activated')->default(false); // 用户激活状态
            $table->string('activation_token')->nullable(); // 用户激活令牌

            $table->rememberToken();

            $table->timestamp('last_login_at'); // 用户上次登录的日期时间
            $table->string('last_login_ip', 32)->nullable()->index(); // 用户上次登陆的 ip 地址
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
        Schema::drop('users');
    }
}
