<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    /**
     * 用户隐私设定模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'privacies';

    /**
     * 准予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'broadcast', // 个人动态广播与否的设置，可选：yes|no，默认：yes
        'message', // 站内信接收设置，可选：any|only|none，所有人、仅相关、拒绝；默认：any
        'email', // 邮件通知接收设置，可选：any|only|none，所有人、仅相关、拒绝；默认：any
    ];

    /**
     * 定义与用户模型相对的一对一关联
     * 获取这些设定项是属于哪一个用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
