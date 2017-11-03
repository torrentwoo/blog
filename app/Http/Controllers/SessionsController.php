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
            'activated' =>  1, // only activated user could login, extra field
        ];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            $nickname = $user->nickname;
            $nickname = $nickname ?: $user->name;
            session()->flash('success', "登录成功，欢迎您回来：{$nickname}");
            return redirect()->route('home')->with('user', $user);
        } else { // Login failed
            session()->flash('danger', '帐号和密码不匹配，或账户未激活，登录失败');
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
