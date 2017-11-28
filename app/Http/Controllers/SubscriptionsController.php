<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    protected $followings;

    public function __construct()
    {
        $this->middleware('auth');

        Auth::check() && $this->followings = Auth::user()->follows()->latest('created_at')->get();
    }

    protected function retrieve($origin = null)
    {
        if ($this->followings->isEmpty()) {
            $origin = $latest = $commented = $popular = [];
        } else {
            if (true !== isset($origin)) { // must be the instance of Column or User
                $origin = $this->followings->first()->followable;
            }
            // The latest articles
            $latest = $origin->articles()->released()->with('author')->latest('released_at')->get();
            // The most commented articles
            $commented = $origin->articles()->released()->with('author', 'comments')->get()->filter(function ($item) {
                return $item->comments->isEmpty() !== true;
            })->sortByDesc(function($item) {
                return $item->comments->count();
            })->values();
            // 热门文章，评定标准：有人喜欢或被评论；排序规则：喜欢数量（倒序）>评论数量（倒序）>文章阅读量（倒序）
            $popular = $origin->articles()->released()->with('author', 'likes', 'comments')->get()->filter(function($e) {
                return $e->views > 0 && $e->likes->count() || $e->comments->count();
            })->sort(function ($a, $b) {
                $factor1 = $b->likes->count() - $a->likes->count();
                $factor2 = $b->comments->count() - $a->comments->count();
                $factor3 = $b->views - $a->views;
                return $factor1 + $factor2 + $factor3;
            })->values();
        }

        return [
            'followings'    =>  $this->followings,
            'origin'        =>  $origin,
            'latest'        =>  $latest,
            'commented'     =>  $commented,
            'popular'       =>  $popular,
        ];
    }

    /**
     * 响应对 GET /subscriptions 的请求
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if ($this->followings->isEmpty()) {
            return redirect()->route('subscription.recommend');
        } else {
            $data = $this->retrieve();

            return view('subscriptions.index', $data)->with('subscriptionActive', 'active');
        }
    }

    /**
     * 响应对 GET /subscriptions/recommendation 的请求
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recommend()
    {
        // 推荐作者，评定标准：有被收藏或喜欢的文章；排序规则：喜欢数（倒序）>已发表文章数（倒序）>被收藏文章数（倒序）
        $authors = User::activated()->with(['articles'  => function($query) {
            $query->released();
        }])->with('favoriteArticles', 'likedArticles')->get()->filter(function($e) {
            return $e->articles->count() > 0 && $e->id !== Auth::id();
        })->sort(function($a, $b) {
            $factor1 = $b->likedArticles->count() - $a->likedArticles->count();
            $factor2 = $b->articles->count() - $a->articles->count();
            $factor3 = $b->favoriteArticles->count() - $a->favoriteArticles->count();
            return $factor1 + $factor2 + $factor3;
        })->values();
        // 推荐栏目，评定标准：有收录文章；排序规则：收录文章数（倒序）>被关注数量（倒序）
        $columns = Column::visible()->with(['articles'  =>  function($query) {
            $query->released();
        }])->with('follows')->get()->filter(function($item) {
            return $item->articles->count() > 0;
        })->sort(function($a, $b) {
            $factor1 = $b->articles->count() - $a->articles->count();
            $factor2 = $b->follows->count() - $a->follows->count();
            return $factor1 + $factor2;
        })->values();

        return view('subscriptions.recommendation', [
            'followings'    =>  $this->followings,
            'authors'       =>  $authors,
            'columns'       =>  $columns,
        ])->with('subscriptionActive', 'active');
    }

    /**
     * 显示某个被关注的栏目其可供订阅的内容
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followingColumn($id)
    {
        $origin = Column::visible()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.column', $data)->with('subscriptionActive', 'active');
    }

    /**
     * 显示某个被关注的用户其可供订阅的内容
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followingUser($id)
    {
        $origin = User::activated()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.user', $data)->with('subscriptionActive', 'active');
    }
}
