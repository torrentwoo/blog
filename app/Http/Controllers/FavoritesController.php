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

    public function add($id)
    {
        //
    }

    public function revoke($id)
    {
        //
    }
}
