<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = \Illuminate\Support\Facades\Auth::user();
    }

    public function add($relation, $id)
    {
        //
    }

    public function revoke($relation, $id)
    {
        //
    }
}
