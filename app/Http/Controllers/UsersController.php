<?php

namespace App\Http\Controllers;

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

        return view('layouts.activation')->with('user', $user);
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
        return view('users.show', [
            'user'  =>  $user,
        ])->with('profile', 'active');
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
        ])->with('account', 'active');
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
        $user = User::with(['articles'  =>  function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        $this->authorize('retrieve', $user);
        return view('users.articles', [
            'articles'  =>  $user->articles,
        ]);
    }

    public function favorites($id)
    {
        //
    }

    public function comments($id)
    {
        //
    }
}
