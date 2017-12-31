<?php

namespace App\Http\Controllers;

use App\Events\UserLikeNotificationEvent;
use Auth;
use Event;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    /**
     * 已登录用户的实例
     *
     * @var
     */
    protected $user;

    /**
     * LikeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->user = Auth::user();
    }

    /**
     * 用户喜欢某篇文章
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addLikeArticle($id)
    {
        $article = Article::findOrFail($id);
        if (!$article->isLikedBy($this->user)) {
            $like = new Like(['user_id' =>  $this->user->id]);
            $article->likes()->save($like);
            // 触发喜欢的通知事件，通知作者其文章被人喜欢了
            $message = [
                'subject'   =>  '您有文章被喜欢',
                'content'   =>  '您的文章《' . $article->title . '》被用户：' . $this->user->name . ' 喜欢了',
            ];
            Event::fire(new UserLikeNotificationEvent($like, $article->author, $message));
        }
        return redirect()->back();
    }

    /**
     * 用户取消喜欢某篇（或者多篇）文章
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeLikeArticle($id)
    {
        $id = true !== is_array($id) ? compact('id') : $id;
        Like::where('user_id', '=', $this->user->id)
            ->where('likable_type', '=', Article::class)
            ->whereIn('likable_id', $id)
            ->delete();
        return redirect()->back();
    }
}
