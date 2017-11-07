<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Article and items appended to this article
        $article  = Article::with('category', 'tags')->with(['comments' => function($query) use ($id) {
            $query->where('article_id', '=', $id)->latest('created_at')->take(4);
        }])->where('id', '=', $id)->firstOrFail();
        // Previous and next
        $columnId = $article->category->id;
        $previous = Article::where('category_id', $columnId)->released()->ofPrev($article->id)->first();
        $next     = Article::where('category_id', $columnId)->released()->ofNext($article->id)->first();
        // Sidebar columns
        $columns  = Category::whereHas('articles', function($query) {
            $query->where('approval', '<>', 0);
        })->visible()->orderBy('priority', 'desc')->get();

        return view('layouts.article', [
            'article'   =>  $article,
            'prev'      =>  $previous,
            'next'      =>  $next,
            'columns'   =>  $columns,
            'column'    =>  $article->category, // position of active element in sidebar
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
