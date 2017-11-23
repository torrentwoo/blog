<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('subscriptions.index')->with('subscriptionActive', 'active');
    }

    public function followingColumns($id)
    {
        return view('subscriptions.column')->with('subscriptionActive', 'active');
    }

    public function followingUsers($id)
    {
        return view('subscriptions.user')->with('subscriptionActive', 'active');
    }
}
