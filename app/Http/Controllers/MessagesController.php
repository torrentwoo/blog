<?php

namespace App\Http\Controllers;

use App\Events\ChatEmitMessageEvent;
use App\Models\User;
use App\Models\OutgoingMessage;
use App\Models\ReceivedMessage;
use Auth;
use Event;

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
        $received = $user->receivedMessages()->whereHas('sender', function($query) {
            $query->whereNotNull('id');
        })->get()->groupBy('from_id')->values();
        $outgoing = $user->outgoingMessages()->whereHas('recipient', function($query) {
            $query->whereNotNull('id');
        })->get()->groupBy('from_id')->values();

        return view('messages.index', [
            'user'      =>  $user,
            'messages'  =>  $received,
            'outgoing'  =>  $outgoing,
        ])->with('notificationActive', 'active');
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

        $outgoing = OutgoingMessage::with('sender')->where('from_id', '=', $export->id)
                    ->where('recipient_id', '=', $import->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
        $received = ReceivedMessage::with('sender')->where('from_id', '=', $import->id)
                    ->where('recipient_id', '=', $export->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
        $messages = $outgoing->merge($received->all())->sortBy('created_at')->values();

        // Mark outgoing & received messages as read
        OutgoingMessage::unread()->where('from_id', '=', $export->id)->where('recipient_id', '=', $import->id)
                                 ->update(['read' =>  true]);
        ReceivedMessage::unread()->where('from_id', '=', $import->id)->where('recipient_id', '=', $export->id)
                                 ->update(['read' =>  true]);

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
        if (!$request->ajax()) {
            $recipient = User::findOrFail($id);
            $myself = Auth::user();
            // Check blacklist
            if ($recipient->blacklist->contains($myself)) {
                session()->flash('warning', "您暂时无法给 {$recipient->name} 发送站内信");
                return redirect()->back();
            }
            // Input validation
            $this->validate($request, [
                'message' => 'required|max:140',
            ], [
                'message.required' => '站内信 的内容不可为空',
                'message.max' => '站内信 的内容不能大于 140 个字符',
            ]);
            // Message data
            $message = [
                'from_id' => $myself->id,
                'recipient_id' => $recipient->id,
                'content' => $request->message,
            ];
            $outgoingMessage = $myself->outgoingMessages()->create($message); // outgoing message for sender
            $receivedMessage = $recipient->receivedMessages()->create($message); // received message for recipient

            Event::fire(new ChatEmitMessageEvent($myself, $recipient, $outgoingMessage));

            return redirect()->back();
        } else {
            $recipient = User::find($id);
            $myself = Auth::user();
            $response = ['error' => true];
            if (empty($recipient)) {
                $response['message'] = 'Invalid message recipient';
                return response()->json($response);
            }
            if ($recipient->blacklist->contains($myself)) {
                $response['message'] = 'Cannot send message to ' . $recipient->name . ' , you are on the blacklist';
                return response()->json($response);
            }
            if ($request->has('message') !== true) {
                $response['message'] = 'Message can not be empty';
                return response()->json($response);
            }
            if (mb_strlen($request->message) > 140) {
                $response['message'] = 'Message too long, be sure message content is less than 140 characters';
                return response()->json($response);
            }

            $message = [
                'from_id' => $myself->id,
                'recipient_id' => $recipient->id,
                'content' => $request->message,
            ];
            $outgoingMessage = $myself->outgoingMessages()->create($message); // outgoing message for sender
            $receivedMessage = $recipient->receivedMessages()->create($message); // received message for recipient

            $response = [
                'error' => false,
                'message' => 'Message been delivered',
                'outgoingMessage' => $outgoingMessage->content,
                'delivered' => $outgoingMessage->created_at->format('n/j g:i a'),
            ];

            Event::fire(new ChatEmitMessageEvent($myself, $recipient, $outgoingMessage));

            return response()->json($response);
        }
    }

    /**
     * 响应对 DELETE /notification/messages/{id} 的请求
     * 删除与指定用户的所有对话
     *
     * @param int $id 发来站内信的用户的 id 标识符
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $sender = User::find($id);
        $myself = Auth::user();
        $response = ['error' => true];
        if (empty($sender)) {
            $sender = new \stdClass();
            $sender->id = $id;
            $sender->name = '该用户';
        }

        OutgoingMessage::where('from_id', '=', $myself->id)->where('recipient_id', '=', $sender->id)->delete();
        ReceivedMessage::where('from_id', '=', $sender->id)->where('recipient_id', '=', $myself->id)->delete();

        if ($request->ajax()) {
            $response = [
                'error'     =>  false,
                'message'   =>  "成功删除了与 {$sender->name} 的所有对话",
            ];
            return response()->json($response);
        } else {
            return redirect()->back();
        }
    }
}
