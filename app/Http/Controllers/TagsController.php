<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::whereHas('articles', function($query) {
            $query->released();
        })->get()->sortBy('name')->values();

        return view('layouts.tagcloud')->with('tags', $tags);
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
        // Querying relationship existence
        $tag = Tag::whereHas('articles', function($query) {
            $query->released();
        })->where('id', '=', $id)->firstOrFail();
        // Pagination of the articles those applied this tag
        $articles = Article::with('attachment', 'snapshot')->whereHas('tags', function($query) use ($id) {
            $query->where('tags.id', '=', $id);
        })->released()->paginate();
        // Other popular tags
        $popular = Tag::with(['articles' => function($query) {
            $query->released();
        }])->get()->filter(function($item) {
            return $item->articles->isEmpty() !== true;
        })->sortByDesc(function($item) {
            return $item->articles->count();
        });

        return view('layouts.tag', [
            'tag'       =>  $tag,
            'articles'  =>  $articles,
            'popular'   =>  $popular,
        ])->with('id', (int) $id);
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
