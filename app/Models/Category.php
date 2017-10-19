<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * 储存分类信息的数据表名称
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * 可予批量赋值的数据表字段名称列表
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
     * 声明类别与子类别之间的一对多关联
     * 一个类别可拥有多个子类别，获取某一类别下属的直接子类别
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * 声明类别与后裔类别之间的一对多关联
     * 一个类别可拥有多个（递进至无限个）后裔类别，获取某一类别下的完整后裔类别（树）
     * 注：通过 Eloquent 的模型递归关联实现
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * 声明类别与子类别之间相对的一对多关联
     * 一个类别可拥有多个子类别，一个子类别向上追溯只属于某一个父级类别
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * 声明祖先类别与子类别之间相对的一对多关联
     * 一个祖先类别可拥有多个后裔类别，某个后裔类别向上追溯只依次属于某一个祖先类别
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    /**
     * 查找某一个类别的兄弟类别
     * 注：兄弟类别是指拥有同一个直接父级类别的分类
     *
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function siblings()
    {
        return $this->where('parent_id', '=', $this->parent_id)->where($this->primaryKey, '!=', $this->id);
    }

    /**
     * 查找所有主类别
     * 注：主类别是指往上追溯没有父分类的类别
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopePrimary($query)
    {
        return $query->where('parent_id', '=', 0);
    }

    /**
     * 定义类别与案例之间的一对多关联
     * 该类别下的所有案例
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id');
    }

    /**
     * 定义类别与资质之间的一对多关联
     * 该类别下的所有资质
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'category_id');
    }
}
