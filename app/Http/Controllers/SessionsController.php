<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    use ThrottlesLogins;

    /**
     * 响应对 GET /auth/login 的请求
     * 显示用户登录表单
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.login')->with('loginActive', 'active');
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
                session()->flash('success', "登录成功，欢迎您回来：{$nickname}");
                //return redirect()->route('home')->with('user', $user);
                return redirect()->intended(route('user.show', [$user]));
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
