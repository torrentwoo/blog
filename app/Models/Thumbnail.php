<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    /**
     * 可予批量赋值的数据表字段名称
     * @var array
     */
    protected $fillable = ['article_id', 'thumbnail_loc', 'thumbnail_url'];

    /**
     * 禁用时间戳记
     *
     * @var bool false
     */
    public $timestamps = false;

    /**
     * 定义文章与文章封面缩略图（预览）之间相对的一对多关联
     * 获取使用此封面缩略图的文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
