<?php

namespace App\Http\Controllers;

use App\Events\UserCommentNotificationEvent;
use Auth;
use Event;

use App\Models\Article;
use App\Models\Comment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleCommentController extends Controller
{
    /**
     * ArticleCommentController constructor.
     */
    public function __construct()
    {
        // 应用 Authenticate 中间件，并应用到控制器的所有方法中，除了 index, show
        $this->middleware('auth', [
            'except'  =>  [
                'index',
                'show',
            ],
        ]);
    }

    /**
     * 显示某一篇的所有评论
     *
     * @param int $articleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($articleId)
    {
        // Retrieve article and its column data
        $article = Article::with('column')->released()->findOrFail($articleId);
        // Retrieve comments those comment on this article
        $comments = $article->comments()->with('commentator')->latest('created_at')->get();
        // Retrieve the top 8 most commented articles that got same column with specified article
        $popular  = Article::with('comments')->released()->get()->filter(function($e) use ($article) {
            return $e->column_id === $article->column_id;
        })->sortByDesc(function($item) {
            return $item->comments->count();
        })->values()->take(8);

        return view('comments.index', [
            'article'   =>  $article,
            'comments'  =>  $comments,
            'popular'   =>  $popular,
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
     * 处理用户对文章的评论
     *
     * @param Request $request
     * @param int $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $articleId)
    {
        // 定位被评论的文章
        $article = Article::released()->findOrFail($articleId);
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
        // 触发评论的通知事件，通知作者其文章被评论了
        $message = [
            'subject'   =>  '您有文章被评论',
            'content'   =>  '您的文章《' . $article->title . '》被用户：' . Auth::user()->name . ' 评论了',
        ];
        Event::fire(new UserCommentNotificationEvent($comment, $article->author, $message));

        return redirect()->back();
    }

    /**
     * 处理用户对评论的回复
     *
     * @param Request $request
     * @param int $articleId
     * @param int $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, $articleId, $commentId)
    {
        // 定位评论所在的文章
        $article = Article::findOrFail($articleId);
        // 定位被回复的评论
        $comment = Comment::findOrFail($commentId);
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

        $url = route('articles.comments.index', $article->id) . '#mark-' . $comment->id;

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
