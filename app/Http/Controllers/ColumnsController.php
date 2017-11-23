<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        $popular = Column::whereHas('articles', function($query) {
            $query->released();
        })->visible()->orderBy('priority', 'desc')->get();

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
        // The most commented articles in this very column
        $commented = $column->articles()->released()->with('author', 'comments')->get()->filter(function($item) {
            return true !== $item->comments->isEmpty();
        })->sortByDesc('comments')->values();
        // Latest articles in this very column
        $latest = $column->articles()->released()->with('author')->latest('released_at')->paginate(10);
        // The popular articles in this column, [considering dimension: views, comments, likes
        $popular = $column->articles()->released()->with('author', 'comments', 'likes')->orderBy('views', 'desc')->get()
            ->filter(function($item) {
                return true !== $item->likes->isEmpty() && $item->views > 0;
            })->sortByDesc('comments')->sortByDesc('likes')->values();

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
