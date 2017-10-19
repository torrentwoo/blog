<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('parent_id')->unsigned()->default(0); // 父级类别标识符
            // 基本属性
            $table->string('name'); // 类别名称
            $table->string('description')->nullable(); // 类别描述
            // 扩展属性
            $table->integer('priority')->unsigned()->default(0); // 排序权值，数值越大权值越高，排位越靠前
            $table->boolean('hidden')->default(false); // 类别是否隐藏
            $table->timestamps();
            // 表的字符集和整理
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
