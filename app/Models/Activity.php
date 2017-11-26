<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'activable_id',
        'activable_type',
        'log_name',
        'description',
        'properties',
    ];

    /**
     * 获取所有拥有 activable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function activable()
    {
        return $this->morphTo();
    }

    /**
     * 定义用户与活动记录之间相对的一对多关联
     * 用于反查活动记录归属的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
