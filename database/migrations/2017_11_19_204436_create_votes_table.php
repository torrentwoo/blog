<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index(); // 属于谁的赞或踩，对应用户表的 id
            // 多态关联属性
            $table->integer('votable_id')->unsigned()->default(0)->index(); // 多态关联模型的主键
            $table->string('votable_type'); // 多态关联模型的名称（会包含命名空间）
            // 基本属性
            $table->enum('type', ['up', 'down'])->default('up'); // 赞 或 踩
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
        Schema::drop('votes');
    }
}
