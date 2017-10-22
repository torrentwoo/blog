<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * 存储附件数据的数据表名称
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * 可予批量赋值的数据表字段名称
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'url',
        'name',
        'type',
        'preview',
    ];

    /**
     * 禁用时间戳记
     *
     * @var bool false
     */
    public $timestamps = false;

    /**
     * 定义文章与文章引用附件之间相对的一对多关联
     * 获取引用此附件的文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
