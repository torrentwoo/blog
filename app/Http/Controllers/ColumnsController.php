<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ColumnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 总栏目索引，排序规则：排序权值（倒序）>文章数量（倒序）>关注人数（倒序）
        $popular = Column::with('follows', 'thumbnails')->with(['articles' => function($query) {
            $query->released();
        }])->visible()->get()->filter(function($e) { // 过滤没有正式发布文章的栏目
            return $e->articles->count() > 0;
        })->sort(function($a, $b) {
            $factor1 = $b->articles->count() - $a->articles->count();
            $factor2 = $b->follows->count() - $a->follows->count();
            return $factor1 + $factor2;
        })->sortByDesc('priority')->values();

        return view('columns.index', [
            'columns'   =>  $popular,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Column itself
        $column = Column::visible()->findOrFail($id);
        // The most commented articles in this column
        $commented = $column->articles()->released()->with('author', 'comments')->get()->filter(function($e) {
            return true !== $e->comments->isEmpty();
        })->sortByDesc('comments')->values();
        // 最新收录（文章），排序规则：文章发表的日期时间（倒序）
        $latest = $column->articles()->released()->with('author')->latest('released_at')->paginate(10);
        // 栏目热门（文章），排序规则：喜欢数量（倒序）>评论数量（倒序）>阅读量（倒序）>发表日期时间（倒序）
        $popular = $column->articles()->released()->with('author', 'comments', 'likes')->get()->filter(function($e) {
            return $e->views > 0 && $e->likes->count() || $e->comments->count();
        })->sort(function($a, $b) {
            $factor1 = $b->likes->count() - $a->likes->count();
            $factor2 = $b->comments->count() - $a->comments->count();
            $factor3 = $b->views - $a->views;
            $factor4 = strcmp($b->released_at, $a->released_at);
            return $factor1 + $factor2 + $factor3 + $factor4;
        })->values();

        return view('columns.show', [
            'column'    =>  $column,
            'commented' =>  $commented,
            'latest'    =>  $latest,
            'popular'   =>  $popular,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
