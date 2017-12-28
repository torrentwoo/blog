<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WritingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 响应对 GET /write 的请求
     * 显示撰写文章的页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function write()
    {
        $editor = Auth::user()->preference()->pluck('editor');
        return view('writing.write', compact('editor'));
    }
}
