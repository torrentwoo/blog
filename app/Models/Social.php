<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /**
     * 用户社交资料模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'socials';

    /**
     * 准予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'douban',
        'facebook',
        'linkedin',
        'qq',
        'twitter',
        'weibo',
        'weixin'
    ];

    /**
     * 定义与用户模型相对的一对一关联
     * 获取是哪个用户拥有这些社交资料
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
