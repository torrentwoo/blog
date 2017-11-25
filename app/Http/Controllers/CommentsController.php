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
     * CommentsController constructor.
     */
    public function __construct()
    {
        // 应用 Authenticate 中间件，并应用到控制器的所有方法中，除了 show
        $this->middleware('auth', [
            'except'  =>  ['show'],
        ]);
    }

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
        // 定位文章
        $article = Article::released()->findOrFail($id);
        // 用户输入验证
        $requireLogin = [];
        $this->validate($request, array_merge($requireLogin, [
            'comment'   =>  'required|min:15',
            'parent_id' =>  'numeric|exists:comments,id',
        ]), [
            'comment.required'  =>  '评论 不能为空',
            'comment.min'       =>  '评论 至少为 15 个字符',
            'parent_id.numeric' =>  '被引用的 评论 无效',
            'parent_id.exists'  =>  '被引用的 评论 无效，该评论或以被删除',
        ]);
        // 构造评论数据
        $comment = new Comment([
            'user_id'   =>  Auth::id(),
            'content'   =>  $request->comment,
        ]);
        // 为文章保存评论数据
        $article->comments()->save($comment);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id the value of article identifier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve article and its column data
        $article = Article::with('column')->released()->findOrFail($id);
        // Retrieve comments those comment on this article
        $comments = $article->comments()->with('commentator')->latest('created_at')->paginate(20);
        // Retrieve the top 8 most commented articles that got same column with specified article
        $popular  = Article::with('comments')->released()->get()->filter(function($e) use ($article) {
            return $e->column_id === $article->column_id;
        })->sortByDesc(function($item) {
            return $item->comments->count();
        })->values()->take(8);

        return view('comments.show', [
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
