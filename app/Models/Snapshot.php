<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snapshot extends Model
{
    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'snapshots';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = ['loc', 'url'];

    /**
     * 获取所有拥有 snapshotable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function snapshotable()
    {
        return $this->morphTo();
    }
}
