<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbnailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thumbnails', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('article_id')->unsigned()->default(0)->index(); // 文章的 id
            // 基本属性
            $table->string('thumbnail_loc', 64); // 引用缩略图的主体（位置、标识符、名称等）
            $table->string('thumbnail_url', 110); // 缩略图的存储地址
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('thumbnails');
    }
}
