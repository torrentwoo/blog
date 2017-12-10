<?php

namespace App\Http\Controllers;

use Auth;
use Event;

use App\Events\UserVoteNotificationEvent;
use App\Models\Comment;
use App\Models\Vote;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 响应对 Ajax /comments/{id}/favour 的请求
     * 给评论投赞成票（点赞）
     *
     * @param int $id 评论的标识符
     * @return \Illuminate\Http\JsonResponse
     */
    public function favour($id)
    {
        $voter = Auth::user();
        $response = ['error' => true];

        $comment = Comment::find($id);
        if (empty($comment) !== true) {
            $vote = new Vote([
                'user_id'   =>  $voter->id,
                'type'      =>  'up',
            ]);
            $comment->votes()->save($vote);
            $response = ['error' => false];

            // Notify the commentator that his comment has been get favour vote
            $content = empty($comment->commentable->title) !== true
                     ? '您在《' . $comment->commentable->title . '》的评论被用户：' . $voter->name . ' 点赞了。'
                     : '您在《' . $comment->topmostComment()->commentable->title . '》的评论被用户：' . $voter->name . ' 点赞了。';
            $message = [
                'subject'   =>  '您有评论被点赞',
                'content'   =>  $content,
            ];
            Event::fire(new UserVoteNotificationEvent($vote, $comment->commentator, $message));
        }
        return response()->json($response);
    }

    /**
     * 响应对 DELETE /comments/{id}/favour 的请求
     * 取消给评论的点赞
     *
     * @param int $id 评论的标识符
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeFavour($id)
    {
        $voter = Auth::user();
        $response = ['error' => true];

        $vote = Vote::withVoter($voter->id)->withType('up')
                    ->where('votable_type', '=', Comment::class)->where('votable_id', '=', $id)
                    ->first();
        if (empty($vote) !== true) {
            $vote->delete();
            $response = ['error' => false];
        }

        return response()->json($response);
    }

    /**
     * 响应对 Ajax /comments/{id}/blackball 的请求
     * 给评论投反对票
     *
     * @param int $id 评论的标识符
     * @return \Illuminate\Http\JsonResponse
     */
    public function oppose($id)
    {
        $voter = Auth::user();
        $response = ['error' => true];

        $comment = Comment::find($id);
        if (empty($comment) !== true) {
            $vote = new Vote([
                'user_id'   =>  $voter->id,
                'type'      =>  'down',
            ]);
            $comment->votes()->save($vote);
            $response = ['error' => false];
        }
        return response()->json($response);
    }

    /**
     * 响应对 DELETE /comments/{id}/blackball 的请求
     * 取消对某个评论的踩
     *
     * @param int $id 评论的标识符
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeOppose($id)
    {
        $voter = Auth::user();
        $response = ['error' => true];

        $vote = Vote::withVoter($voter->id)->withType('down')
                    ->where('votable_type', '=', Comment::class)->where('votable_id', '=', $id)
                    ->first();
        if (empty($vote) !== true) {
            $vote->delete();
            $response = ['error' => false];
        }

        return response()->json($response);
    }
}
