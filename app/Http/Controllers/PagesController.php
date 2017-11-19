<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
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
        // Articles
        $articles = Article::released()->latest('released_at')->with('thumbnails')->take(6)->get();
        // Sidebar columns list
        $columns  = Category::whereHas('articles', function($query) {
            $query->released();
        })->visible()->orderBy('priority', 'desc')->take(7)->get();

        return view('layouts.home', [
            'articles'  =>  $articles,
            'columns'   =>  $columns,
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
