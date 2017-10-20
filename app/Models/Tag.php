<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * 定义标签与文章之间的多对多关联
     * 获取使用该标签的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'tag_clouds', 'tag_id', 'article_id');
    }
}
