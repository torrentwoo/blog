<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlacklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blacklists', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index(); // 谁的，关联到用户表 id
            $table->integer('blocked_id')->unsigned()->default(0)->index(); // 被屏蔽的用户，关联到用户表 id
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
        Schema::drop('blacklists');
    }
}
