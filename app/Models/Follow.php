<?php

namespace App\Models;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use LogActivities;

    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'follows';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * 获取所有拥有 followable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function followable()
    {
        return $this->morphTo();
    }

    /**
     * 定义用于与关注之间相对的一对多关联
     * 获取此关注归属的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
