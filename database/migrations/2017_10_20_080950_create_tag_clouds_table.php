<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagCloudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_clouds', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('tag_id')->unsigned()->default(0)->index(); // 应用的哪个标签，对应标签表的 id
            $table->integer('article_id')->unsigned()->default(0)->index(); // 哪篇文章使用此标签，对应文章表的 id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag_clouds');
    }
}
