<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
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

    /**
     * 响应对 GET /notification/messages/{id} 的请求
     * 显示由某个用户发起的会话详情页面
     *
     * @param int $id 某个用户的 id 标识符
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $import = User::findOrFail($id);
        $export = Auth::user();
        $messages = Message::with('sender')
            ->orWhere(function($query) use ($import, $export) {
                $query->where('from_id', '=', $import->id)->where('recipient_id', '=', $export->id);
            })->orWhere(function($query) use ($import, $export) {
                $query->where('from_id', '=', $export->id)->where('recipient_id', '=', $import->id);
            })->orderBy('created_at', 'asc')
            ->get();

        return view('messages.show', compact('import', 'messages'))->with('notificationActive', 'active');
    }

    /**
     * 响应对 POST /notification/messages/{id} 的请求
     * 处理用户发送的站内信
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request, $id)
    {
        $recipient = User::findOrFail($id);
        $myself = Auth::user();
        // Check blacklist
        if ($recipient->blacklist->contains($myself)) {
            session()->flash('warning', "您暂时无法给 {$recipient->name} 发送站内信");
            return redirect()->back();
        }
        // Input validation
        $this->validate($request, [
            'message'   =>  'required|max:140',
        ], [
            'message.required'  =>  '站内信 的内容不可为空',
            'message.max'       =>  '站内信 的内容不能大于 140 个字符',
        ]);
        $message = Message::create([
            'from_id'       =>  $myself->id,
            'recipient_id'  =>  $recipient->id,
            'content'       =>  $request->message,
        ]);
        /*
        if ($message instanceof Message) {
            session()->flash('success', '站内信发送成功');
        }*/

        return redirect()->back();
    }
}
