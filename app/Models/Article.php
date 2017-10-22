<?php

namespace App\Models;

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
        'title', // 文章标题
        'keywords', // 文章关键词
        'description', // 文章描述
        'content', // 文章内容
        'source', // 文章来源（枚举：原创、转载、投稿）
        'author', // 文章作者
        'visited', // 文章浏览次数
        'priority',
        'approval',
    ];

    /**
     * 查找上一篇文章
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $id    Value of the identifier
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPrev($query, $id)
    {
        return $query->where('id', '=', $query->where('id', '<', $id)->max('id'));
    }

    /**
     * 查找下一篇文章
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @param $id    Value of the identifier
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfNext($query, $id)
    {
        return $query->where('id', '=', $query->where('id', '>', $id)->min('id'));
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
}
