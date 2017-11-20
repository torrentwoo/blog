<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    /**
     * 文章模型使用的数据库表的名称
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'category_id', // 文章的类别
        'title', // 文章标题
        'keywords', // 文章关键词
        'description', // 文章描述
        'content', // 文章内容
        'source', // 文章来源（枚举：原创、转载、投稿）
        'author', // 文章作者
        'approval', // 文章的审核标志
        'priority', // 文章的排序权重数值
        'views', // 文章浏览次数
        'released_at', // 文章指定的发布日期时间
    ];

    /**
     * 额外需要遵照 Carbon 对象处理的日期时间字段（对象）
     * 
     * @var array
     */
    protected $dates = ['released_at'];

    /**
     * 将 released_at 字段的值转换为 Carbon 对象且拥有时间日期属性的实例
     *
     * @param $date
     */
    public function setReleasedAtAttribute($date)
    {
        $this->attributes['released_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * 查找释出日期时间在当前之前的所有文章
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReleased($query)
    {
        return $query->where('approval', '<>', 0)->where('released_at', '<=', Carbon::now());
    }

    /**
     * 查找上一篇文章
     *
     * @param $query    \Illuminate\Database\Eloquent\Builder
     * @param $id       Value of the article identifier
     * @return mixed    \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPrev($query, $id)
    {
        return $query->where('id', '=', $query->where('id', '<', $id)->max('id'));
    }

    /**
     * 查找下一篇文章
     *
     * @param $query    \Illuminate\Database\Eloquent\Builder
     * @param $id       Value of the identifier
     * @return mixed    \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfNext($query, $id)
    {
        return $query->where('id', '=', $query->where('id', '>', $id)->min('id'));
    }

    /**
     * 定义作者与文章之间相对的一对多关联
     * 一个用户可能发表多篇作品，确定文章归属的作者
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 定义类别与文章之间相对的一对多关联
     * 一个类别下会拥有多篇文章，确定文章归属的类别
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * 获取文章的所有评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * 定义文章与标签之间的多对多关联
     * 获取此文章使用的所有标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_clouds', 'article_id', 'tag_id');
    }

    /**
     * 获取文章的所有引用附件（包括 audio/picture/video）
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * 获取文章的缩略图
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function thumbnails()
    {
        return $this->morphMany(Snapshot::class, 'snapshotable');
    }

    /**
     * 获取文章的收藏
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    /**
     * 判断文章是否已被当前登录的用户所收藏
     *
     * @return bool
     */
    public function isFavorite()
    {
        return (boolean) $this->favorites()->with('user')->get()->pluck('user')->contains(
            Auth::check() ? Auth::user() : 0
        );
    }

    /**
     * 获取文章的喜欢
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    /**
     * 获取所有喜欢这篇文章的用户
     *
     * @return \Illuminate\Support\Collection
     */
    public function likedUsers()
    {
        $arrUserId = Like::where('likable_type', '=', Article::class)->where('likable_id', '=', $this->id)
            ->lists('user_id')->toArray();
        return User::whereIn('id', $arrUserId)->get();
    }

    /**
     * 判断文章是否已被当前登录的用户所喜欢
     *
     * @return bool
     */
    public function isLiked()
    {
        return (boolean) $this->likes()->with('user')->get()->pluck('user')->contains(
            Auth::check() ? Auth::user() : 0
        );
    }
}
