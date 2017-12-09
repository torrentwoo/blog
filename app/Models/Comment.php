<?php

namespace App\Models;

use App\Traits\LogActivities;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use LogActivities;

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
    public function commentator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 获取评论的回复（子集评论、可嵌套）
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|\Illuminate\Database\Eloquent\Builder
     */
    public function replies()
    {
        return $this->morphMany(self::class, 'commentable')->orderBy('created_at', 'asc');
    }

    /**
     * 获取评论（或回复）所附属的对象
     * 若存在该对象，它可能指向的是一条评论，也可能指向的是某一篇文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(self::class, 'commentable_id', 'id');
    }

    /**
     * 获取评论（或回复）所附属的最顶层的评论
     * 可以通过这个方法，反查某一个被嵌套的评论（或回复）所属的文章
     *
     * @return Comment
     */
    public function topmostComment()
    {
        $parent = $this->origin;
        while ($parent->parent_id !== 0) {
            $parent = $parent->origin;
        }
        return $parent;
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

    /**
     * 获取评论的通知
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notification()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
