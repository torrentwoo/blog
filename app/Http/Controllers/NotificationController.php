<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Auth;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * NotificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 响应对 GET /notification 的请求
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('message.index');
    }

    /**
     * 响应对 GET /notification/comments 的请求
     * 显示用户收到的评论的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comment()
    {
        $user = Auth::user();

        $comments = $user->notification()->withType('comment')->get();

        return view('notification.comments.index', [
            // Navigation and position
            'notificationActive'    =>  'active',
            'commentActive'         =>  true,
            // Data
            'comments'              =>  $comments,
        ]);
    }

    /**
     * 响应对 GET /notification/comments/{id} 的请求
     * 显示用户收到的评论的通知详情页面
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showComment($id)
    {
        $notification = Notification::findOrFail($id);

        return view('notification.comments.show', [
            // Navigation and position
            'notificationActive'    =>  'active',
            'commentActive'         =>  true,
            // Data
            'notification'          =>  $notification,
        ]);
    }

    /**
     * 响应对 DELETE/POST /notification/comments/{id} 的请求
     * 删除有关评论的指定通知消息
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroyComment($id)
    {
        if (Request::ajax()) { // Ajax request
            $response = ['error' => true];
            $notification = Notification::find($id);
            if (empty($notification)) {
                $response['message'] = '删除失败，找不到这一条记录';
            } else {
                $notification->delete();
                $response = [
                    'error'     =>  false,
                    'message'   =>  '成功删除一条通知消息',
                ];
            }
            return response()->json($response);
        } else { // via DELETE request
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return redirect()->back();
        }
    }

    /**
     * 响应对 GET /notification/requests 的请求
     * 显示用户收到的投稿邀约的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function request()
    {
        $user = Auth::user();

        $requests = $user->notification()->withType('request')->get();

        return view('notification.requests.index', [
            'notificationActive'    =>  'active',
            'requestActive'         =>  true,
            'requests'              =>  $requests,
        ]);
    }

    /**
     * 响应对 GET /notification/likes 的请求
     * 显示用户收到的喜欢的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function like()
    {
        $user = Auth::user();

        $likes = $user->notification()->withType('like')->get();

        return view('notification.likes.index', [
            'notificationActive'    =>  'active',
            'likeActive'            =>  true,
            'likes'                 =>  $likes,
        ]);
    }

    /**
     * 响应对 GET /notification/likes/{id} 的请求
     * 显示用户收到的喜欢的通知详情页面
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLike($id)
    {
        $notification = Notification::findOrFail($id);

        return view('notification.likes.show', [
            // Navigation and position
            'notificationActive'    =>  'active',
            'likeActive'            =>  true,
            // Data
            'notification'          =>  $notification,
        ]);
    }

    /**
     * 响应对 DELETE/POST /notification/likes/{id} 的请求
     * 删除有关喜欢的指定通知消息
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroyLike($id)
    {
        if (Request::ajax()) { // Ajax request
            $response = ['error' => true];
            $notification = Notification::find($id);
            if (empty($notification)) {
                $response['message'] = '删除失败，找不到这一条记录';
            } else {
                $notification->delete();
                $response = [
                    'error'     =>  false,
                    'message'   =>  '成功删除一条通知消息',
                ];
            }
            return response()->json($response);
        } else { // via DELETE request
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return redirect()->back();
        }
    }

    /**
     * 显示对 GET /notification/votes 的请求
     * 显示用户收到的点赞的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vote()
    {
        $user = Auth::user();

        $votes = $user->notification()->withType('vote')->get();

        return view('notification.votes.index', [
            'notificationActive'    =>  'active',
            'voteActive'            =>  true,
            'votes'                 =>  $votes,
        ]);
    }

    /**
     * 响应对 GET /notification/follow 的请求
     * 显示用户收到的被关注的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function follow()
    {
        $user = Auth::user();

        $follows = $user->notification()->withType('follow')->get();

        return view('notification.follow.index', [
            'notificationActive'    =>  'active',
            'followActive'          =>  true,
            'follows'               =>  $follows,
        ]);
    }

    /**
     * 响应对 GET /notification/follow/{id} 的请求
     * 显示用户收到被人关注的通知页面
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFollow($id)
    {
        $notification = Notification::findOrFail($id);

        return view('notification.follow.show', [
            // Navigation and position
            'notificationActive'    =>  'active',
            'followActive'          =>  true,
            // Data
            'notification'          =>  $notification,
        ]);
    }

    /**
     * 响应对 DELETE/POST /notification/follow/{id} 的请求
     * 删除用户的被关注的指定通知消息
     *
     * @param int $id 通知消息的标识符
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroyFollow($id)
    {
        if (Request::ajax()) { // Ajax request
            $response = ['error' => true];
            $notification = Notification::find($id);
            if (empty($notification)) {
                $response['message'] = '删除失败，找不到这一条记录';
            } else {
                $notification->delete();
                $response = [
                    'error'     =>  false,
                    'message'   =>  '成功删除一条通知消息',
                ];
            }
            return response()->json($response);
        } else { // via DELETE request
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return redirect()->back();
        }
    }

    /**
     * 响应对 GET /notification/rewards 的请求
     * 显示用户收到的赞赏的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reward()
    {
        $user = Auth::user();

        $rewards = $user->notification()->withType('reward')->get();

        return view('notification.rewards.index', [
            'notificationActive'    =>  'active',
            'rewardActive'          =>  true,
            'rewards'               =>  $rewards,
        ]);
    }

    /**
     * 响应对 GET /notification/others 的请求
     * 显示用户收到的所有未定义归类的通知页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function others()
    {
        $user = Auth::user();

        $others = $user->notification()->withType('undefined')->get();

        return view('notification.others', [
            'notificationActive'    =>  'active',
            'othersActive'          =>  true,
            'others'                =>  $others,
        ]);
    }
}
