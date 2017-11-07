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
        $articles = Article::released()->latest('released_at')->with('attachment', 'snapshot')->take(6)->get();
        // Sidebar columns list
        $columns  = Category::whereHas('articles', function($query) {
            $query->where('approval', '<>', 0);
        })->visible()->orderBy('priority', 'desc')->get();

        return view('layouts.home', [
            'articles'  =>  $articles,
            'columns'   =>  $columns,
        ])->with('homeActive', 'active');
    }
}
