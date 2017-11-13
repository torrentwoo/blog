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
}
