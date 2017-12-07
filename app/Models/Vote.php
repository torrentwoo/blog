<?php

namespace App\Models;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use LogActivities;

    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = ['user_id', 'type'];

    /**
     * 限制查找发起者为指定用户的投票
     *
     * @param $query    \Illuminate\Database\Eloquent\Builder
     * @param $user_id  The numeric value of user identifier
     * @return          \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithVoter($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    /**
     * 限制查找某一指定类型的投票
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $type  The string value of voted type, accept: up, down
     * @return       \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    /**
     * 获取所有拥有 votable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function votable()
    {
        return $this->morphTo();
    }

    /**
     * 定义用户与赞踩之间相对的一对多关联
     * 获取此投票（赞或踩）归属于哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 获取点赞的通知
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
