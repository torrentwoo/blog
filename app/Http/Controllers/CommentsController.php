<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
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
     * @param  int                       $id      the value of article identifier
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $requireLogin = Auth::check() ? [] : [
            'username'  =>  'required',
            'password'  =>  'required',
        ];
        $this->validate($request, array_merge($requireLogin, [
            'comment'   =>  'required|min:15',
        ]));
        // Handle user login
        if (!Auth::check()) {
            $credentials = [
                'name'      =>  $request->username,
                'password'  =>  $request->password,
                'activated' =>  1, // only activated user could login, extra field
            ];
            if (!Auth::attempt($credentials, $request->has('remember'))) {
                abort(403, 'Authentication failed, require user login');
            }
        }
        // Handle inserting related models
        $data = new Comment([
            'user_id'   =>  Auth::user()->id,
            'content'   =>  $request->comment,
        ]);
        $article = Article::findOrFail($id);
        $article->comments()->save($data);

        return redirect()->back(); // redirect()->intended(route('comments', $id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id the value of article identifier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve article data from model article and category
        $article  = Article::with('category')->where('id', '=', $id)->released()->firstOrFail();
        // Retrieve comments those comment on this article
        $comments = $article->comments()->with('user')->orderBy('created_at', 'desc')->paginate(10);
        // Retrieve top 8 popular articles that been commented on
        $popular  = Article::with('comments')->released()->get()->sortBy('comments')->reverse()->take(8);

        return view('layouts.comments', [
            'article'   =>  $article,
            'comments'  =>  $comments,
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
