<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        'visited', // 文章浏览次数
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
     * @param $columnId Value of the category identifier
     * @return mixed    \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPrev($query, $id, $columnId = null)
    {
        if (isset($columnId)) {
            return $query->where('id', '=', $query->where('id', '<', $id)->max('id'))
                ->where('category_id', '=', $columnId);
        } else {
            return $query->where('id', '=', $query->where('id', '<', $id)->max('id'));
        }
    }

    /**
     * 查找下一篇文章
     *
     * @param $query    \Illuminate\Database\Eloquent\Builder
     * @param $id       Value of the identifier
     * @param $columnId Value of the category identifier
     * @return mixed    \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfNext($query, $id, $columnId)
    {
        if (isset($columnId)) {
            return $query->where('id', '=', $query->where('id', '>', $id)->min('id'))
                ->where('category_id', '=', $columnId);
        } else {
            return $query->where('id', '=', $query->where('id', '>', $id)->min('id'));
        }
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
     * 定义文章与文章评论之间的一对多关联
     * 获取该篇文章下的所有评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
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
     * 定义文章与文章引用附件之间的一对多关联
     * 获取该篇文章下的所有引用附件（包括 audio/picture/video）
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'article_id');
    }

    /**
     * 定义文章与文章预览附件之间的一对一关联
     * 获取该篇文章的预览附件（可能是 audio/picture/video）
     *
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'article_id')->where('preview', '<>', 0)->orderBy('id')->take(1);
    }

    /**
     * 定义文章与文章引用的缩略图之间的一对多关联
     * 获取该篇文章下的所有缩略图
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class, 'article_id');
    }

    /**
     * 定义文章与文章缩略图之间的一对一关联
     * 获取该篇文章（对应指定路由名称）的一个缩略图
     *
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function snapshot()
    {
        return $this->hasOne(Thumbnail::class, 'article_id')
                    ->where('thumbnail_loc', '=', \Illuminate\Support\Facades\Route::currentRouteName())
                    ->orderBy('id')
                    ->take(1);
    }
}
