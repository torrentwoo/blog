<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        // Invoke middleware via constructor
        $this->middleware('auth', [
            'only'  =>  [
                'edit',
                'update',
                'destroy',
                'articles', // 用户的文章
                'favorites', // 用户的收藏
                'comments', // 用户的评论
                //'balance', // 用户的账户余额
                //'gifts', // 用户的卡券
                //'cart', // 用户的购物车
            ],
        ]);
        // 通过构造方法调用中间件，只让未登录用户访问用户注册、用户激活页面
        $this->middleware('guest', [
            'only'  =>  ['create', 'activate'],
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
        return view('auth.register')->with('registerActive', 'active');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'  =>  'required|between:4,32|unique:users,name', // all printable characters are accepted
            //'username'  =>  ['required', 'min:4', 'max:32', 'regex:/^[a-z]+[\x2d\x2e\x5f]?[a-z\d]+?$/'], // pattern
            'email'     =>  'required|email|unique:users|max:255',
            'password'  =>  'required|min:6|confirmed',
        ]);
        $user = User::create([
            'name'      =>  $request->username,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);
        // Send an account activation message to user via mail
        $this->sendActivationMessage($user);

        session()->flash('success', '注册验证通知邮件已经发送到您的注册邮箱，请注意查收');

        return view('users.activation')->with('user', $user);
    }

    /**
     * Send an account activation message to specified user
     *
     * @param \App\Models\User $recipient
     */
    public function sendActivationMessage(User $recipient)
    {
        $view     = 'emails.activation';
        $user     = $recipient;
        $data     = compact('user');
        $from     = 'admin@dev.local';
        $fromName = 'admin';
        $to       = $user->email;
        $subject  = '注册验证通知邮件';
        Mail::send($view, $data, function($message) use ($from, $fromName, $to, $subject) {
            $message->from($from, $fromName)->to($to)->subject($subject);
        });
    }

    /**
     * Activate a specified user with a token
     *
     * @param string $token the value of activation token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($token)
    {
        $user = User::where('activation_token', '=', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save(); // update

        Auth::login($user);
        $nickname = $user->nickname;
        $nickname = $nickname ?: $user->name;
        session()->flash('success', "恭喜您：{$nickname}，您的账户已成功激活，祝愿您在这里开启一段愉快的旅程");

        return redirect()->route('home')->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $activities = [];
        // 热门文章，排序规则：文章喜欢数（倒序）>文章评论数（倒序）>文章阅读量（倒序）
        $popular = $user->articles()->released()->with('comments', 'likes')->get()->sort(function($a, $b) {
            $factor1 = $b->likes->count() - $a->likes->count();
            $factor2 = $b->comments->count() - $a->comments->count();
            $factor3 = $b->views - $a->views;
            return $factor1 + $factor2 + $factor3;
        })->values();
        // 热评文章，必须被人评论过，按评论数量倒序整理
        $comments = $user->articles()->with('comments')->get()->filter(function($item) {
            return $item->comments->count() > 0;
        })->sortByDesc(function($item) {
            return $item->comments->count();
        })->values();

        return view('users.home', [
            'user'          =>  $user,
            'activities'    =>  $activities,
            'popular'       =>  $popular,
            'comments'      =>  $comments,
        ])->with('userProfileActive', 'active');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Make sure user can only edit profile belongs himself
        $this->authorize('update', $user);
        return view('users.edit', [
            'user'  =>  $user,
        ])->with('userAccountActive', 'active');
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
        $user = User::findOrFail($id);
        // Make sure user can only edit profile belongs himself
        $this->authorize('update', $user);
        $this->validate($request, [
            'nickname'  =>  "min:2|unique:users,nickname,{$user->id}",
            'password'  =>  'confirmed|min:6',
        ]);
        $data = [];
        if ($request->has('nickname')) {
            $data['nickname'] = $request->nickname;
        }
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if (empty($data) !== true) {
            $user->update($data);
            session()->flash('success', '您的账户更新成功');
        }
        return redirect()->route('user.show', $user->id);
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

    /**
     * 列出用户创建（包含已发表）过的所有文章
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles($id)
    {
        $user = User::findOrFail($id);
        // Authenticate
        $this->authorize('retrieve', $user);
        // The latest released articles
        $latest = $user->articles()->released()->latest('released_at')->get();
        // 热评文章，上热评条件：有被评论；排序规则：评论数量（倒序）
        $commented = $user->articles()->with('comments')->get()->filter(function($item) {
            return $item->comments->count() > 0;
        })->sortByDesc(function($item) {
            return $item->comments->count();
        })->values();
        // 热门文章，排序规则：文章喜欢数（倒序）>文章评论数（倒序）>文章阅读量（倒序）
        $popular = $user->articles()->released()->with('comments', 'likes')->get()->sort(function($a, $b) {
            $factor1 = $b->likes->count() - $a->likes->count();
            $factor2 = $b->comments->count() - $a->comments->count();
            $factor3 = $b->views - $a->views;
            return $factor1 + $factor2 + $factor3;
        })->values();

        return view('users.articles', [
            'user'      =>  $user,
            'latest'    =>  $latest,
            'commented' =>  $commented,
            'popular'   =>  $popular,
        ])->with('userArticlesActive', 'active');
    }

    /**
     * 列出用户收藏过的所有文章
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favorites($id)
    {
        // User
        $user = User::findOrFail($id);
        // Authenticate
        $this->authorize('retrieve', $user);
        // All the articles liked by current user
        $liked = $user->likedArticles()->get()->sort(function($a, $b) {
            return strcmp($b->pivot->created_at, $a->pivot->created_at);
        })->values();
        // All the articles collected by current user
        $favorites = $user->favoriteArticles()->get()->sort(function($a, $b) {
            return strcmp($b->pivot->created_at, $a->pivot->created_at);
        })->values();

        return view('users.favorites', [
            'user'      =>  $user,
            'liked'     =>  $liked,
            'favorites' =>  $favorites,
        ])->with('userFavoritesActive', 'active');
    }

    /**
     * 列出用户发表过的所有评论
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments($id)
    {
        // Retrieve user
        $user = User::findOrFail($id);
        // Authenticate
        $this->authorize('retrieve', $user);
        // All comments belong to user
        $myComments = $user->comments()->latest('created_at')->get();
        // 他人的评论（在我发表的文章上）
        $othersComments = Comment::where('commentable_type', '=', Article::class)
                                 ->whereIn('commentable_id', $user->articles()->released()->get()->pluck('id')->all())
                                 ->orderBy('created_at', 'desc')
                                 ->get()
                                 ->groupBy('commentable_id')
                                 ->values();
        //dd($othersComments->toArray());
        // 他人的回复（在我发表的评论上）
        $othersReplies = Comment::where('commentable_type', '=', Comment::class)
                                ->whereIn('commentable_id', $myComments->pluck('id')->all())
                                ->orderBy('created_at', 'desc')
                                ->get()
                                ->groupBy('commentable_id')
                                ->values();
        //dd($othersReplies->toArray());

        return view('users.comments', [
            'user'          =>  $user,
            'myComments'    =>  $myComments,
            'othersComments'=>  $othersComments,
            'othersReplies' =>  $othersReplies,
        ])->with('userCommentsActive', 'active');
    }
}
