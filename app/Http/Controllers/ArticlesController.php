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
            $query->where('article_id', '=', $id)->orderBy('created_at', 'desc')->take(4);
        }])->where('id', '=', $id)->firstOrFail();
        // Sidebar columns
        $columns  = Category::where('hidden', '=', 0)->whereHas('articles', function($query) {
            $query->where('approval', '<>', 0);
        })->get();

        return view('layouts.article', [
            'article'   =>  $article,
            'prev'      =>  $article->ofPrev($article->id, $article->category->id)->released()->first(),
            'next'      =>  $article->ofNext($article->id, $article->category->id)->released()->first(),
            'columns'   =>  $columns,
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
