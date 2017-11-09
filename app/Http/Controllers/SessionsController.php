<?php

namespace App\Http\Controllers;

use App\Events\UserLoginEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class SessionsController extends Controller
{
    use ThrottlesLogins;

    /**
     * SessionsController constructor.
     */
    public function __construct()
    {
        // 通过构造方法调用中间件，只让未登录用户访问登录页面
        $this->middleware('guest', [
            'only'  =>  ['create'],
        ]);
    }

    /**
     * 响应对 GET /auth/login 的请求
     * 显示用户登录表单
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login')->with('headMeta', [
            'title'     =>  '用户登陆',
            'robots'    =>  'noindex,nofollow',
        ])->with('loginActive', 'active');
    }

    /**
     * 响应对 POST /auth/login 的请求
     * 处理用户登录
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'  =>  'required',
            'password'  =>  'required',
        ]);
        $credentials = [
            'name'      =>  $request->username,
            'password'  =>  $request->password,
        ];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            if ($user->activated) {
                $nickname = $user->nickname;
                $nickname = $nickname ?: $user->name;
                // 记录（处理）用户登录事件
                Event::fire(new UserLoginEvent($user, Carbon::now(), $request->ip()));

                session()->flash('success', "登录成功，欢迎您回来：{$nickname}");
                return redirect()->intended(route('user.show', compact('user')));
            } else {
                Auth::logout();
                session()->flash('warning', '您的账户未激活，请登陆您的注册邮箱，检查注册验证邮件以便激活您的账户');
                return redirect()->route('home');
            }
        } else { // Login failed
            session()->flash('danger', '帐号和密码不匹配，登录失败');
            return redirect()->back();
        }
    }

    /**
     * 响应对 GET /auth/logout 的请求
     * 处理用户注销（退出登录）
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出登录状态');
        return redirect()->route('login');
    }
}
