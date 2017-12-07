<?php

namespace App\Models;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use LogActivities;

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

    /**
     * 定义用户与喜欢之间相对的一对多关联
     * 获取此喜欢归属哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function liker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 获取喜欢的通知
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
