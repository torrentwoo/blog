<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Datetime field
     * @var array
     */
    protected $dates = ['last_login_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'location',
        'nickname',
        'avatar',
        'introduction',
        'last_login_at', // datetime
        'last_login_ip',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_token'];

    /**
     * 当用户创建（注册）时，自动生成 activation_token 值
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function($user) {
            $user->activation_token = str_random(32);
        });
    }

    /**
     * 限制查找所有已激活的用户
     *
     * @param $query \Illuminate\Database\Eloquent\Builder
     * @return mixed \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivated($query)
    {
        return $query->where('activated', '<>', 0);
    }

    /**
     * 利用 Gravatar 替用户生成头像
     *
     * @link https://cn.gravatar.com/site/implement/images/
     * @param int $size 头像的尺寸（像素）
     * @return string   可予显示的头像（图像）资源地址
     */
    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d=mm&r=pg";
    }

    /**
     * 定义用户（作者）与文章之间的一对多关联
     * 获取作者发表过的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    /**
     * 定义用户与评论之间的一对多关联
     * 获取某一个用户发表过的所有评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * 定义用户与收藏之间的多对多关联
     * 获取某一个用户收藏过的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Article::class, 'favorites', 'user_id', 'article_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    /**
     * 获取用户的粉丝列表（被哪些人关注）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'fans_id')
                    ->withTimestamps();
    }

    /**
     * 获取用户的关注列表（关注了哪些人）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'fans_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * 判断当前用户是否关注了某个指定的用户
     *
     * @param $user
     * @return boolean
     */
    public function isFollowing($user)
    {
        return $this->followings->contains($user);
    }

    /**
     * 判断某个指定的用户是否在一个（模型所指的）用户的粉丝列表内
     *
     * @param $user
     * @return boolean
     */
    public function hasFan($user)
    {
        return $this->followers->contains($user);
    }
}
