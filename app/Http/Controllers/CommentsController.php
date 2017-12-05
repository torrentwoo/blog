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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 处理用户对文章的评论
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request, $id)
    {
        // 定位被评论的文章
        $article = Article::released()->findOrFail($id);
        // 验证用户端的输入
        $this->validate($request, [
            'comment'   =>  'required|min:15',
        ], [
            'comment.required'  =>  '评论内容 不能为空',
            'comment.min'       =>  '评论内容 至少为 15 个字符',
        ]);
        // 构造文章评论数据
        $comment = new Comment([
            'user_id'   =>  Auth::id(),
            'content'   =>  $request->comment,
        ]);
        // 为文章保存评论数据
        $article->comments()->save($comment);

        return redirect()->back();
    }

    /**
     * 处理用户对评论的回复
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, $id)
    {
        // 定位被回复的评论
        $comment = Comment::findOrFail($id);
        // 验证用户端的输入
        $this->validate($request, [
            'reply' =>  'required|min:15',
        ], [
            'reply.required'    =>  '回复内容 不能为空',
            'reply.min'         =>  '回复内容 至少为 15 个字符',
        ]);
        // 构造评论回复数据
        $reply = new Comment([
            'user_id'   =>  Auth::id(),
            'parent_id' =>  $comment->id,
            'content'   =>  $request->reply,
        ]);
        // 为评论保存回复数据
        $comment->replies()->save($reply);

        if ($request->has('articleId')) {
            $url = route('article.comments', $request->articleId) . '#mark-' . $comment->id;
            return redirect($url);
        } else {
            return redirect()->back();
        }
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
        $comments = $article->comments()->with('commentator')->latest('created_at')->get();
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
