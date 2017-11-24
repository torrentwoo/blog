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

    /**
     * 关注某个栏目
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function followColumn($id)
    {
        $column = Column::findOrFail($id);
        if (!$column->isFollowedBy($this->user)) {
            $column->follows()->save(
                new Follow(['user_id' => $this->user->id])
            );
        }
        return redirect()->back();
    }

    /**
     * 取消关注某个（或者某些）栏目
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeFollowColumn($id)
    {
        $id = !is_array($id) ? compact('id') : $id;
        Follow::whereIn('followable_id', $id)
              ->where('user_id', '=', $this->user->id)
              ->where('followable_type', '=', Column::class)
              ->delete();

        return redirect()->back();
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
        }
        return redirect()->back();
    }

    /**
     * 取消关注某个（或者某些）用户
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeFollowUser($id)
    {
        $id = true !== is_array($id) ? compact('id') : $id;
        $this->user->followedUsers()->detach($id);

        return redirect()->back();
    }
}
