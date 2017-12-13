<?php

namespace App\Http\Controllers;

use Auth;
use Event;

use App\Events\UserLoginEvent;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
                $location = $request->has('redirect')
                          ? $request->redirect
                          : route('user.show', compact('user'));

                // 记录（处理）用户登录事件
                Event::fire(new UserLoginEvent($user));

                session()->flash('success', "登录成功，欢迎您回来：{$nickname}");
                return redirect()->intended($location);
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
     * 响应对 POST /auth/ajaxLogin 的请求
     * 处理用户以 ajax 方式的登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxLogin(Request $request)
    {
        $response    = [ // Default response
            'error'     =>  true,
            'message'   =>  '系统故障，请稍候再尝试',
        ];
        $credentials = [
            'name'      =>  $request->username,
            'password'  =>  $request->password,
        ];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            if ($user->activated) {
                $nickname = $user->nickname;
                $nickname = $nickname ?: $user->name;
                // 处理用户登录事件
                Event::fire(new UserLoginEvent($user));
                $response = [
                    'error'     =>  false,
                    'message'   =>  "登录成功，欢迎您回来：{$nickname}",
                ];
            } else {
                Auth::logout();
                $response = [
                    'error'     =>  true,
                    'message'   =>  '账户未激活，登录失败；请先激活您的账户',
                ];
            }
        } else {
            $response = [
                'error'     =>  true,
                'message'   =>  '帐号和密码不匹配，登录失败',
            ];
        }
        return response()->json($response);
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
