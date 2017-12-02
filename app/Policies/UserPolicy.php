<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 判断当前登录用户和进行授权的用户是否为同一个用户（若为同一用户，则通过授权）
     *
     * @param User $currentUser 默认为当前登录用户实例
     * @param User $user        要进行授权的用户实例
     * @return bool
     */
    protected function isOneself(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * 如果当前登录用户和请求授权的用户为同一用户，允许其拥有更新自身账户的能力
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function update(User $currentUser, User $user)
    {
        return $this->isOneself($currentUser, $user);
    }

    /**
     * 如果当前登录用户和请求授权的用户为同一用户，允许其拥有取回自身数据的能力
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function retrieve(User $currentUser, User $user)
    {
        return $this->isOneself($currentUser, $user);
    }

    /**
     * 判断当前登录的用户是否在某一指定用户的黑名单内
     *
     * @param User $subject 当前登录的用户
     * @param User $object  某一指定的用户
     * @return bool         若当前登录的用户在指定用户的黑名单上时，返回布尔值真
     */
    protected function isOnBlacklist(User $subject, User $object)
    {
        return (boolean) $object->blacklists->contains($subject);
    }

    /**
     * 判断评论用户是否在作者的黑名单中
     *
     * @param User $commentator 评论用户
     * @param User $author      作者
     * @return bool             注：最终返回结果必须取反，以实现授权策略
     */
    public function comment(User $commentator, User $author)
    {
        return !$this->isOnBlacklist($commentator, $author);
    }

    /**
     * 判断评论用户提及（艾特）的某一用户，其黑名单内是否有评论用户自身
     *
     * @param User $commentator
     * @param User $user
     * @return bool
     */
    public function mention(User $commentator, User $user)
    {
        return !$this->isOnBlacklist($commentator, $user);
    }

    /**
     * 判断站内信发信人是否在收信人的黑名单内
     *
     * @param User $from
     * @param User $to
     * @return bool
     */
    public function message(User $from, User $to)
    {
        return !$this->isOnBlacklist($from, $to);
    }

    /**
     * 判断关注者是否在被关注用户的黑名单内
     *
     * @param User $follower
     * @param User $user
     * @return bool
     */
    public function follow(User $follower, User $user)
    {
        return !$this->isOnBlacklist($follower, $user);
    }
}
