<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * 已登录用户的模型
     *
     * @var
     */
    protected $user;

    /**
     * LikesController constructor.
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
            $article->likes()->save(
                new Like(['user_id' =>  $this->user->id])
            );
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
