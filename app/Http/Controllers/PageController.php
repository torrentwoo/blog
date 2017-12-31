<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Column;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * 响应对 GET / 的请求
     * 显示网站首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Carousel
        // 首页栏目，排序规则：最新收录（日期时间，倒序）>文章数量（倒序）>排序权值（倒序）
        $columns = Column::with(['articles'  =>  function($query) {
            $query->released()->orderBy('released_at', 'desc');
        }])->visible()->get()->filter(function($e) {
            return $e->articles->count() > 0;
        })->sort(function($a, $b) {
            return $b->articles->count() - $a->articles->count();
        })->values()->take(7);
        // 首页文章，排序规则：喜欢数量（倒序）>评论数量（倒序）>发表时间
        $articles = Article::with('comments', 'likes', 'thumbnails')->released()->get()->sort(function($a, $b) {
            $flag  = $b->likes->count() - $a->likes->count();
            $flag .= $b->comments->count() - $a->comments->count();
            $flag .= strcmp($b->released_at, $a->released_at);
            return $flag;
        })->values()->take(6);

        return view('layouts.home', [
            'columns'   =>  $columns,
            'articles'  =>  $articles,
        ])->with('homeActive', 'active');
    }
    /**
     * 响应对 GET /about 的请求
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('layouts.about');
    }

    /**
     * 响应对 GET /contact 的请求
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('layouts.contact');
    }

    /**
     * 响应对 GET /help 的请求
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help()
    {
        return view('layouts.help')->with('helpActive', 'active');
    }

    /**
     * 响应对 GET /search 的请求
     * 显示站内搜索、搜索结果页面
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        return view('layouts.search');
    }
}
