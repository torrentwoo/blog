<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 响应对 GET /notification/messages 的请求
     * 显示用户的站内信页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $messages = $user->messages()->with('sender')->get()->groupBy('from_id')->values();

        return view('messages.index', compact('user', 'messages'))->with('notificationActive', 'active');
    }
}
