<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');
            // 关联属性
            $table->integer('user_id')->unsigned()->default(0)->index();
            // 基本属性
            $table->enum('editor', ['CKEditor', 'Markdown'])->default('CKEditor');
            $table->enum('reward', ['yes', 'no'])->default('yes');
            $table->string('reward_description')->nullable(); // only take effect when reward option is yes
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
        Schema::drop('preferences');
    }
}
