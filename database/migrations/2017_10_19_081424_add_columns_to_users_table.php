<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 基础属性
            $table->string('nickname')->nullable()->after('password'); // 用户昵称（保证唯一性）
            // 扩展属性
            $table->boolean('activated')->default(false)->after('nickname'); // 用户激活状态
            $table->string('activation_token')->nullable()->after('activated'); // 用户激活令牌
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
