<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    /**
     * 作者（用户）偏好设置模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'preferences';

    /**
     * 准予批量赋值的数据表字段名称
     * @var array
     */
    protected $fillable = [
        'user_id',
        'editor',
        'reward',
        'reward_description',
    ];

    /**
     * 定义与作者（用户）之间相对的一对一关联
     * 获取这些设定项归属于哪一个作者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
