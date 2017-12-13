<?php

namespace App\Http\Controllers;

use App\Events\ArticleBrowseEvent;
use App\Models\Article;
use Event;

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
        // Article and related that appended to
        $article  = Article::with('column', 'tags')->with(['comments' => function($query) use ($id) {
            $query->latest('created_at')->take(4);
        }])->released()->findOrFail($id);
        // Previous and next of this very article
        $columnId = $article->column->id;
        $previous = Article::where('column_id', $columnId)->released()->ofPrev($article->id)->first();
        $next     = Article::where('column_id', $columnId)->released()->ofNext($article->id)->first();
        // Related articles recommendation
        $keywords = $article->keywords;
        $tags     = $article->tags->lists('name')->toArray();
        $recommend= [];

        // Handle article browse event
        Event::fire(new ArticleBrowseEvent($article));

        return view('articles.show', [
            'article'   =>  $article,
            'prev'      =>  $previous,
            'next'      =>  $next,
            'recommend' =>  $recommend,
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
