<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('category_id')->unsigned()->default(0)->index(); // 类别的 id
            // 基本属性
            $table->string('title'); // 文章标题
            $table->string('keywords')->nullable(); // 文章关键词
            $table->string('description')->nullable(); // 文章描述
            $table->text('content'); // 文章内容
            // 扩展属性
            $table->enum('source', ['original', 'reproduced', 'contributed'])->default('original'); // 文章来源（原创、转载、投稿）
            $table->string('author', 64)->nullable(); // 文章作者

            $table->boolean('approval')->default(false); // 审核选项（可见性，管理员操作项）
            $table->integer('priority')->unsigned()->default(0); // 文章的排序权值（数值越大，排序越靠前）
            $table->integer('views')->unsigned()->default(0); // 浏览次数

            $table->timestamp('released_at')->nullable(); // 文章指定的发布日期时间
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
        Schema::drop('articles');
    }
}
