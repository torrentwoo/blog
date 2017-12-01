<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        // 通过构造方法调用中间件，使得下列页面（方法）只能由已登录的用户访问
        $this->middleware('auth', [
            'only'  =>  [
                'showProfile', 'updateProfile',
                'showSocials', 'updateSocials',
                'showPrivacy', 'updatePrivacy',
                'showAssists', 'updateAssists',
                'showAccount', 'updateAccount',
                'destroy',
                'articles', // 用户的文章
                'favorites', // 用户的收藏
                'comments', // 用户的评论
                //'balance', // 用户的账户余额
                //'gifts', // 用户的卡券
                //'cart', // 用户的购物车
            ],
        ]);
        // 通过构造方法调用中间件，使得用户注册页面、用户激活页面只能由未登录的用户访问
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
        // 用户动态
        $activities = $user->activities()->latest('created_at')->get();
        // 热门文章，排序规则：文章喜欢数（倒序）>文章评论数（倒序）>文章阅读量（倒序）
        $popular = $user->articles()->released()->with('comments', 'likes')->get()->sort(function($a, $b) {
            $factor1 = $b->likes->count() - $a->likes->count();
            $factor2 = $b->comments->count() - $a->comments->count();
            $factor3 = $b->views - $a->views;
            return $factor1 + $factor2 + $factor3;
        })->values();
        // 热评文章，评定标准：必须被人评论过；排序规则：按评论数量倒序排列
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

    public function showProfile($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        return view('users.profile', [
            'user'              =>  $user,
            'userAccountActive' =>  'active',
        ])->with('updateProfile', true);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Make sure user can only edit profile belongs himself
        $this->authorize('update', $user);

        $this->validate($request, [
            'avatar'        =>  "image|max:2048", // unit:kb
            'location'      =>  "min:2|max:32",
            'nickname'      =>  "min:4|max:32|unique:users,nickname,{$user->id}",
            'introduction'  =>  "min:15|max:140",
        ], [
            'avatar.image'      =>  '头像 必须为有效的图片',
            'avatar.max'        =>  '头像 不能大于 2M',
            'location.min'      =>  '所在地 至少为 2 个字符',
            'location.max'      =>  '所在地 不能大于 32 个字符',
            'nickname.min'      =>  '用户昵称 至少为 4 个字符',
            'nickname.max'      =>  '用户昵称 不能大于 32 个字符',
            'nickname.unique'   =>  '用户昵称 已被占用',
            'introduction.min'  =>  '个人简介 至少为 15 个字符',
            'introduction.max'  =>  '个人简介 不能大于 140 个字符',
        ]);
        $data = [];
        // 处理头像上传
        if ($request->hasFile('avatar') && config('filesystems.default') === 'local') {
            $root = config('filesystems.disks.local.root');
            $pathname = 'avatars';
            $basename = "user-{$user->id}-avatar.jpg";
            if (empty($pathname) !== true) {
                Storage::makeDirectory($pathname);
                $filename = "{$pathname}/{$basename}";
            } else {
                $filename = $basename;
            }

            $image = Image::make($request->file('avatar'))->resize(128, 128)->save("{$root}/{$filename}");

            $data['avatar'] = $filename;
        }
        if ($request->has('gender')) {
            $data['gender'] = $request->gender;
        }
        if ($request->has('location')) {
            $data['location'] = $request->location;
        }
        if ($request->has('nickname')) {
            $data['nickname'] = $request->nickname;
        }
        if ($request->has('introduction')) {
            $data['introduction'] = $request->introduction;
        }
        if (empty($data) !== true) {
            $user->update($data);
            session()->flash('success', '您的个人资料更新成功');
        }
        return redirect()->back();
    }

    public function showSocials($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        return view('users.socials', compact('user'))->with('updateSocials', true);
    }

    public function updateSocials(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $this->validate($request, [
            'weibo'     =>  'url',
            'weixin'    =>  'image|max:1024',
            'qq'        =>  'numeric',
            'douban'    =>  'url',
            'linkedin'  =>  'url',
            'facebook'  =>  'url',
            'twitter'   =>  'url',
        ], [
            'weibo.url'     =>  '微博 不是有效的网址',
            'weixin.image'  =>  '微信 必须是有效的图片',
            'weixin.max'    =>  '微信 不能大于 1M',
            'qq.numeric'    =>  'QQ 只能是数字',
            'douban.url'    =>  '豆瓣 不是有效的网址',
            'linkedin.url'  =>  'LinkedIn (领英) 不是有效的网址',
            'facebook.url'  =>  'Facebook 不是有效的网址',
            'twitter.url'   =>  'Twitter (推特) 不是有效的网址',
        ]);
        $data = [];
        if ($request->has('weibo')) {
            $data['weibo'] = $request->weibo;
        }
        if ($request->hasFile('weixin') && config('filesystems.default') === 'local') {
            $root = config('filesystems.disks.local.root');
            $pathname = 'socials';
            $basename = "user-{$user->id}-weixin.jpg";
            if (empty($pathname) !== true) {
                Storage::makeDirectory($pathname);
                $filename = "{$pathname}/{$basename}";
            } else {
                $filename = $basename;
            }

            $image = Image::make($request->file('weixin'))->resize(128, 128)->save("{$root}/{$filename}");

            $data['weixin'] = $filename;
        }
        if ($request->has('qq')) {
            $data['qq'] = $request->qq;
        }
        if ($request->has('douban')) {
            $data['douban'] = $request->douban;
        }
        if (empty($data) !== true) {
            empty($user->socials) ? $user->socials()->create($data) : $user->socials->update($data);
            session()->flash('success', '您的社交帐号更新成功');
        }
        return redirect()->back();
    }

    public function showPrivacy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        return view('users.privacy', compact('user'))->with('updatePrivacy', true);
    }

    public function updatePrivacy(Request $request, $id)
    {
        //
    }

    public function showAssists($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        return view('users.assists', compact('user'))->with('updateAssists', true);
    }

    public function updateAssists(Request $request, $id)
    {
        //
    }

    public function showAccount($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        return view('users.account', compact('user'))->with('updateAccount', true);
    }

    public function updateAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $this->validate($request, [
            'password'  =>  'confirmed|min:6',
        ]);
        $data = [];
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if (empty($data) !== true) {
            $user->update($data);
            session()->flash('success', '您的账号密码更新成功');
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
        // All comments that belongs to current user
        $myComments = $user->comments()->latest('created_at')->get();
        // All comments (replies included) that attached to user articles (or comment)
        $othersComments = Comment::with('commentator')
            ->orWhere(function($query) use ($user) {
                $query->where('commentable_type', '=', Article::class)
                      ->whereIn('commentable_id', $user->articles()->released()->get()->pluck('id')->all());
            })->orWhere(function($query) use ($myComments) {
                $query->where('commentable_type', '=', Comment::class)
                      ->whereIn('commentable_id', $myComments->pluck('id')->all());
            })->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('commentable_id')
            ->values();

        return view('users.comments', [
            'user'          =>  $user,
            'myComments'    =>  $myComments,
            'othersComments'=>  $othersComments,
        ])->with('userCommentsActive', 'active');
    }
}
