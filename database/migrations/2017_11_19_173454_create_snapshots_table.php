<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnapshotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshots', function (Blueprint $table) {
            $table->increments('id');
            // 多态关联属性
            $table->integer('snapshotable_id')->unsigned()->default(0)->index(); // 多态关联模型的主键
            $table->string('snapshotable_type'); // 多态关联模型的名称（会包含命名空间）
            // 基本属性
            $table->string('loc', 64)->nullable(); // 引用缩略图的主体的（位置、标识符、名称等）
            $table->string('url', 110); // 缩略图的存储地址
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
        Schema::drop('snapshots');
    }
}
