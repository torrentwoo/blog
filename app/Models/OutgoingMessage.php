<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingMessage extends Model
{
    /**
     * 站内信已发出消息模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'outgoing_messages';

    /**
     * 准予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'from_id',
        'recipient_id',
        'content',
        'read',
        'mark',
    ];

    /**
     * 查找所有未读的站内信
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('read', '<>', true);
    }

    /**
     * 查找所有指定标记的站内信
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
     * 定义与站内信发送者（用户）之间相对的一对多关联
     * 反查站内信的发送者是哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    /**
     * 定义与站内信接收者（用户）之间相对的一对多关联
     * 反查站内信的接收者是哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
