<?php

namespace App\Models;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use LogActivities;

    /**
     * 是否记录用户对 Favorite 模型上的事件
     *
     * @var bool
     */
    protected $logModelEvents = false;
    /**
     * 可被触发的 Eloquent 模型上的事件的名称集合
     *
     * @see https://laravel.com/docs/5.1/eloquent#events
     * @var array
     */
    protected static $logEvents = ['created'];

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
     * 定义用户与收藏之间相对的一对多关联
     * 获取此收藏所归属的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collector()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
