<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index(); // 谁发表的这个评论，对应用户表的 id
            $table->integer('parent_id')->unsigned()->default(0)->index(); // 父级评论的 id
            // 多态关联属性
            $table->integer('commentable_id')->unsigned()->default(0)->index(); // 多态关联模型的主键
            $table->string('commentable_type'); // 多态关联模型的名称（会包含命名空间）
            // 基础属性
            $table->text('content'); // 评论内容
            // 扩展属性
            $table->timestamps();
            // 扩展属性（表采用的字符集和连接整理）
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
