<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    /**
     * 用户模型
     *
     * @var
     */
    protected $user;

    /**
     * FollowsController constructor.
     */
    public function __construct()
    {
        // Default all methods of this class been protected by auth middleware
        $this->middleware('auth');

        $this->user = Auth::user();
    }

    public function followColumn($id)
    {
        $column = Column::findOrFail($id);
        if (!$column->isFollowedBy($this->user)) {
            //$column->follows()->sync([$this->user->id], false);
            $column->follows()->save(
                new Follow(['user_id' => $this->user->id])
            );
        }
        return redirect()->back();
    }

    public function revokeFollowColumn($id)
    {
        //
    }

    /**
     * 关注某个用户
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function followUser($id)
    {
        $user = User::findOrFail($id);
        if ($this->user->id !== $user->id && !$this->user->isFollowed($user)) {
            $this->user->followedUsers()->sync([$user->id], false);
            //$user->followingUsers()->sync([$this->user->id], false);
        }
        return redirect()->back();
    }

    /**
     * 取消关注某个（或一些）用户
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeFollowUser($id)
    {
        $user = User::findOrFail($id);
        $id = true !== is_array($id) ? compact('id') : $id;
        $this->user->followedUsers()->detach($id);
        return redirect()->back();
    }
}
