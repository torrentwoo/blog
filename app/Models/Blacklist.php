<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    /**
     * 黑名单模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'blacklists';

    /**
     * 准予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = ['user_id', 'blocked_id'];

    /**
     * 定义与用户之间相对的多对多关联
     * 获取所有被列入黑名单的用户信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'blacklists', 'blocked_id', 'user_id');
    }
}
