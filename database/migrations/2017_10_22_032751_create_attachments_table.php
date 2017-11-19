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
            // 多态关联属性
            $table->integer('attachable_id')->unsigned()->default(0)->index(); // 多态关联模型的主键
            $table->string('attachable_type'); // 多态关联模型的名称（会包含命名空间）
            // 基本属性
            $table->string('url', 110); // 附件的储存地址
            $table->string('name', 64)->nullable(); // 附件的名称
            $table->string('type', 32)->default('unknown'); // 附件的类型，诸如：audio, picture, video
            // 扩展属性
            $table->timestamp();
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
