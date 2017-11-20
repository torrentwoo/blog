<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * 模型使用的数据库表名称
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'user_id',   // 用户的 id 标识符
        'parent_id', // 父级评论的 id 标识符
        'content',   // 评论的内容
    ];

    /**
     * 获取所有拥有 commentable 的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

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
     * 获取评论的子集评论（可嵌套）
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|\Illuminate\Database\Eloquent\Builder
     */
    public function comments()
    {
        return $this->morphMany(self::class, 'commentable')->orderBy('created_at', 'desc');
    }

    /**
     * 获取评论的赞或踩
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    /**
     * 获取评论的收藏
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }
}
