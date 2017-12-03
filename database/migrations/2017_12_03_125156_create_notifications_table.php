<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('messenger_id')->unsigned()->default(0)->index(); // who brought this message
            $table->integer('recipient_id')->unsigned()->default(0)->index();
            // 多态属性
            $table->integer('notifiable_id')->unsigned()->default(0)->index();
            $table->string('notifiable_type');
            // 基本属性
            $table->enum('type', [
                'comment',
                'request',
                'vote',
                'like',
                'follow',
                'reward',
                'undefined',
            ])->default('undefined')->index();
            $table->string('subject')->nullable();
            $table->string('content')->nullable();
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
        Schema::drop('notifications');
    }
}
