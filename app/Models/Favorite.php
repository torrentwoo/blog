<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'favorites';

    /**
     * 可予批量赋值的字段名称集合
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * 获取所有拥有 favorable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function favorable()
    {
        return $this->morphTo();
    }

    /**
     * 定义用于与收藏之间相对的一对多关联
     * 获取此收藏的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
