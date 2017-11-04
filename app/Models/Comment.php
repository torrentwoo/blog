<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'user_id',    // 用户的 ID 标识符
        'article_id', // 文章的 ID 标识符
        'content',    // 评论的内容
    ];

    /**
     * 定义用户与用户评论之间相对的一对多关联
     * 获取发表此评论的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 定义文章与文章评论之间相对的一对多关联
     * 获取拥有此评论的文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
