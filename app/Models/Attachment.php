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
     * 禁用时间戳记
     *
     * @var bool false
     */
    public $timestamps = false;
}
