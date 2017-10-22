<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('article_id')->unsigned()->default(0)->index(); // 文章的 id
            // 基本属性
            $table->string('url', 110); // 附件的储存地址
            $table->string('name', 64)->nullable(); // 附件的名称
            $table->string('type', 32)->default('unknown'); // 附件的类型，诸如：audio, picture, video
            // 扩展属性
            $table->boolean('preview')->default(false)->indexable(); // 是否可作为预览图像（缩略图，仅限于 picture 类型）
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachments');
    }
}
