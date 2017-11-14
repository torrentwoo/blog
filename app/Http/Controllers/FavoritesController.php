<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    /**
     * 用户模型
     *
     * @var
     */
    protected $user;

    /**
     * FavoritesController constructor.
     */
    public function __construct()
    {
        // 所有方法都受到 auth 中间件的控制
        $this->middleware('auth');

        $this->user = Auth::user();
    }

    /**
     * 喜欢 一篇文章
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addLike(Request $request, $id)
    {
        $this->user->favorites()->sync([$id  =>  ['type'  =>  'like']], false);
        return redirect()->back();
    }

    /**
     * 取消 喜欢 一篇文章
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeLike(Request $request, $id)
    {
        $this->user->favorites()->detach($id);
        return redirect()->back();
    }

    /**
     * 收藏 一篇文章
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addMark(Request $request, $id)
    {
        $this->user->favorites()->sync([$id  =>  ['type'  =>  'mark']], false);
        return redirect()->back();
    }

    /**
     * 取消 收藏 一篇文章
     * 
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revokeMark(Request $request, $id)
    {
        $this->user->favorites()->detach($id);
        return redirect()->back();
    }
}
