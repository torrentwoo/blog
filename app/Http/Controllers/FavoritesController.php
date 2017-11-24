<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Favorite;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    /**
     * 已登录用户的模型
     *
     * @var
     */
    protected $user;

    /**
     * FavoritesController constructor.
     */
    public function __construct()
    {
        // 所有方法都受到 auth 中间件的控制
        $this->middleware('auth');

        $this->user = Auth::user();
    }

    /**
     * 用户收藏某篇文章
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFavoriteArticle($id)
    {
        $article = Article::findOrFail($id);
        if (!$article->isFavoriteBy($this->user)) {
            $article->favorites()->save(
                new Favorite(['user_id' => $this->user->id])
            );
        }
        return redirect()->back();
    }

    /**
     * 用户取消收藏某篇（或多篇）文章
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeFavoriteArticle($id)
    {
        $id = true !== is_array($id) ? compact('id') : $id;
        Favorite::where('user_id', '=', $this->user->id)
                ->whereIn('favorable_id', $id)
                ->where('favorable_type', '=', Article::class)
                ->delete();
        return redirect()->back();
    }
}
