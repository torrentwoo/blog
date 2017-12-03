<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * 消息通知模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * 准予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'messenger_id',
        'recipient_id',
        'notifiable_id',
        'notifiable_type',
        'type',
        'subject',
        'content',
        'read',
        'mark',
    ];

    /**
     * 查找所有未读的消息通知
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('read', '<>', true);
    }

    /**
     * 查找所有指定类型的消息通知
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $type  string|array
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithType($query, $type)
    {
        $type = is_array($type) !== true ? compact('type') : $type;
        return $query->whereIn('type', $type);
    }

    /**
     * 查找所有指定标记的消息通知
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $mark  string|array
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMark($query, $mark)
    {
        $mark = is_array($mark) !== true ? compact('mark') : $mark;
        return $query->whereIn('mark', $mark);
    }

    /**
     * 查找所有拥有 notifiable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * 查找是哪个用户带来的这个消息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messenger()
    {
        return $this->belongsTo(User::class, 'messenger_id');
    }

    /**
     * 定义与消息接收者（用户）之间相对的一对多关联
     * 反查消息通知的接收者是哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
