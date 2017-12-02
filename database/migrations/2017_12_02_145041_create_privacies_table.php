<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacies', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index();
            // 基本属性
            $table->enum('broadcast', ['yes', 'no'])->default('enable'); // 个人动态广播设置
            $table->enum('message', ['any', 'only', 'none'])->default('any'); // 站内信接收设置
            $table->enum('email', ['any', 'only', 'none'])->default('any'); // 邮件通知接收设置
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
        Schema::drop('privacies');
    }
}
