<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
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
        $articles = Article::latest()->released()->orderBy('released_at', 'desc')->take(6)->get();
        // Sidebar columns list
        $columns  = Category::where('hidden', '=', 0)->whereHas('articles', function($query) {
            $query->where('approval', '<>', 0);
        })->get();
        return view('layouts.home', [
            'articles'  =>  $articles,
            'columns'   =>  $columns,
        ])->with('homeActive', 'active');
    }
}
