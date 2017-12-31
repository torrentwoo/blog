<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class TagController extends Controller
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

        return view('tags.index')->with('tags', $tags);
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
        // Get the specified tag that has one released article at least
        $tag = Tag::whereHas('articles', function($query) {
            $query->released();
        })->findOrFail($id);
        // Get the articles those applied current tag, and paginate them
        $data = $tag->with('articles.thumbnails')->get()->filter(function($item) use ($tag) {
            return $item->id = $tag->id && $item->name === $tag->name;
        })->first()->articles->filter(function($item) {
            return $item->approval != 0 && $item->released_at <= Carbon::now();
        })->values();
        // Paginate by manual
        $perPage = 15;
        $currentPage = Paginator::resolveCurrentPage();
        $totalArticles = $data->count();
        $articles = $data->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $pagination = new LengthAwarePaginator($articles, $totalArticles, $perPage, $currentPage, [
            'path'      =>  Paginator::resolveCurrentPath(),
            'pageName'  =>  'page',
        ]); // -- manual pagination end --

        // Other popular tags
        $popular = Tag::with(['articles' => function($query) {
            $query->released();
        }])->get()->filter(function($item) {
            return $item->articles->isEmpty() !== true;
        })->sortByDesc(function($item) {
            return $item->articles->count();
        });

        return view('tags.show', [
            'tag'       =>  $tag,
            'articles'  =>  $articles,
            'pagination'=>  $pagination,
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
