<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * 可予批量赋值的数据表字段名称
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * 获取所有拥有 likable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likable()
    {
        return $this->morphTo();
    }
}
