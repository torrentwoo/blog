<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('parent_id')->unsigned()->default(0); // 父级栏目标识符
            // 基本属性
            $table->string('name'); // 栏目名称
            $table->string('description')->nullable(); // 栏目描述
            // 扩展属性
            $table->integer('priority')->unsigned()->default(0); // 排序权值，数值越大权值越高，排位越靠前
            $table->boolean('hidden')->default(false); // 栏目是否隐藏
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
        Schema::drop('columns');
    }
}
