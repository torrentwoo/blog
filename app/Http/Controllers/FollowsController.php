<?php

namespace App\Http\Controllers;

use App\Events\UserFollowNotificationEvent;
use Auth;
use Event;

use App\Models\Column;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FollowsController extends Controller
{
    /**
     * 已登录用户的模型
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
     * 用户关注某个栏目
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
     * 用户取消关注某个（或者某些）栏目
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeFollowColumn($id)
    {
        $id = !is_array($id) ? compact('id') : $id;
        Follow::where('user_id', '=', $this->user->id)
              ->where('followable_type', '=', Column::class)
              ->whereIn('followable_id', $id)
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
            //$this->user->followedUsers()->sync([$user->id], false); // method sync cannot trigger Eloquent model event
            // But method save and create can trigger Eloquent model events
            $follow = new Follow;

            $follow->user_id = $this->user->id;
            $follow->followable_id = $user->id;
            $follow->followable_type = User::class;

            $follow->save();
            // Notify the user that he has been "added to the following list" by someone
            $message = [
                'subject'   =>  '您被人关注啦',
                'content'   =>  '用户：' . $this->user->name . ' 关注了您',
            ];
            Event::fire(new UserFollowNotificationEvent($follow, $user, $message));
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
