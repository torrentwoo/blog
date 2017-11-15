<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
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
     * 关注某个用户
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id)
    {
        $user = User::find($id);
        if ($this->user->id !== $user->id) {
            if (!$this->user->isFollowing($user)) {
                $this->user->followings()->sync([$user->id], false);
            }
        }
        return redirect()->back();
    }

    /**
     * 取消关注某个（或一些）用户
     *
     * @param int|array $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = true !== is_array($id) ? compact('id') : $id;
        $this->user->followings()->detach($id);
        return redirect()->back();
    }
}
