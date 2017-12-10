<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_messages', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('from_id')->unsigned()->default(0)->index();
            $table->integer('recipient_id')->unsigned()->default(0)->index();
            // 基本属性
            $table->string('content');
            $table->boolean('read')->default(false)->index();
            $table->string('mark', 32)->nullable()->index();
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
        Schema::drop('received_messages');
    }
}
