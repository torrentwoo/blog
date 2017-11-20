<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    /**
     * 模型使用的数据表名称
     *
     * @var string
     */
    protected $table = 'columns';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'priority',
        'hidden',
    ];

    /**
     * 查找所有可见的栏目
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('hidden', '=', 0);
    }

    /**
     * 声明栏目与子栏目之间的一对多关联
     * 一个栏目可拥有多个子栏目，获取某一栏目下属的直接子栏目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Column::class, 'parent_id', 'id');
    }

    /**
     * 声明栏目与后裔栏目之间的一对多关联
     * 一个栏目可拥有多个（递进至无限个）后裔栏目，获取某一栏目下的完整后裔栏目（树）
     * 注：通过 Eloquent 的模型递归关联实现
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * 声明栏目与子栏目之间相对的一对多关联
     * 一个栏目可拥有多个子栏目，一个子栏目向上追溯只属于某一个父级栏目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Column::class, 'parent_id', 'id');
    }

    /**
     * 声明祖先栏目与子栏目之间相对的一对多关联
     * 一个祖先栏目可拥有多个后裔栏目，某个后裔栏目向上追溯只依次属于某一个祖先栏目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    /**
     * 查找某一个栏目的兄弟栏目
     * 注：兄弟栏目是指拥有同一个直接父级栏目的栏目
     *
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function siblings()
    {
        return $this->where('parent_id', '=', $this->parent_id)->where($this->primaryKey, '!=', $this->id);
    }

    /**
     * 查找所有主栏目
     * 注：主栏目是指往上追溯没有父栏目的栏目
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrimary($query)
    {
        return $query->where('parent_id', '=', 0);
    }

    /**
     * 定义栏目与文章之间的一对多关联
     * 该栏目下的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'column_id');
    }

    /**
     * 获取栏目的关注
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    /**
     * 获取所有关注本栏目的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function followingUsers()
    {
        return $this->morphToMany(User::class, 'followable', 'follows')
                    ->withPivot('created_at');
    }

    /**
     * 是否被某人关注
     *
     * @param mixed $someone 某个被指代的用户，可以是用户模型，用户 id 标识符
     * @return bool
     */
    public function isFollowedBy($someone)
    {
        return (boolean) $this->followingUsers->contains($someone);
    }
}
