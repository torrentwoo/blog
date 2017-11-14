<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * Favorite 模型使用的表名称
     *
     * @var string
     */
    protected $table = 'favorites';

    /**
     * 可予批量赋值的字段名称集合
     *
     * @var array
     */
    protected $fillable = ['type', 'user_id', 'article_id'];

    /**
     * 限制查找所有被 喜欢 的记录
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLikes($query)
    {
        return $query->where('type', '=', 'like');
    }

    /**
     * 限制查找所有被 收藏 的记录
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFavorites($query)
    {
        return $query->where('type', '=', 'mark');
    }
}
