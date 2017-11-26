<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index(); // 属于谁的活动记录，对应用户表的 id
            // 多态关联属性
            $table->integer('activable_id')->unsigned()->default(0)->index(); // 多态关联模型的主键
            $table->string('activable_type'); // 多态关联模型的名称（会包含命名空间）
            // 基础属性
            $table->string('log_name'); // 关于活动记录的类型的表述，可利用其分类
            $table->string('description'); // 活动记录的描述
            $table->string('properties')->nullable(); // 用于记录自定义的额外数据
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
        Schema::drop('activities');
    }
}
