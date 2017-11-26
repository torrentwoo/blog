<?php

namespace App\Models;

use App\Traits\LogActivities;
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
    use LogActivities;

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
     * 获取某一个用户发表过的所有评论（包含评论的具体内容）
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id')->with('commentable');
    }

    /**
     * 定义用户与赞踩之间的一对多关联
     * 获取某一个用户赞踩过的所有内容
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id')->with('votable');
    }

    /**
     * 定义用户与收藏之间的一对多关联
     * 获取某一个用户收藏过的所有内容
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id')->with('favorable');
    }

    /**
     * 获取用户收藏过的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function favoriteArticles()
    {
        return $this->morphedByMany(Article::class, 'favorable', 'favorites')
                    ->withPivot('created_at');
    }

    /**
     * 定义用户与喜欢之间的一对多关联
     * 获取某一个用户喜欢着的所有内容
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id')->with('likable');
    }

    /**
     * 获取用户喜欢的所有文章
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function likedArticles()
    {
        return $this->morphedByMany(Article::class, 'likable', 'likes')
                    ->withPivot('created_at');
    }

    /**
     * 获取所有喜欢这个用户发表的文章的用户
     *
     * @return \Illuminate\Support\Collection
     */
    public function likedUsers()
    {
        // Get all identifiers of articles released by user
        $temp = $this->articles()->lists('id')->toArray();
        // Get all identifiers of users those like the specified articles
        $swap = Like::where('likable_type', '=', Article::class)->whereIn('likable_id', $temp)
            ->lists('user_id')->toArray();
        // Get users
        return User::whereIn('id', $swap)->get();
    }

    /**
     * 定义用户与关注之间的一对多关联
     * 获取某一个用户关注了的所有内容
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id')->with('followable');
    }

    /**
     * 获取用户的关注列表（关注了哪些人）
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function followedUsers()
    {
        return $this->morphedByMany(User::class, 'followable', 'follows')
                    ->withPivot('created_at');
    }

    /**
     * 获取用户的粉丝列表（被哪些人关注）
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function followingUsers()
    {
        return $this->morphToMany(User::class, 'followable', 'follows')
                    ->withPivot('created_at');
    }

    /**
     * 是否在关注某人
     *
     * @param mixed $someone 某个被指代的用户，可以是用户模型，用户 id 标识符
     * @return bool
     */
    public function isFollowed($someone)
    {
        return (boolean) $this->followedUsers->contains($someone);
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

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id')->with('activable');
    }
}
