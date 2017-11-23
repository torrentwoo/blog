<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get following list
        $followings = Auth::user()->follows()->get();
        // Get the first element, retrieve its data, to put them into default view
        $first = $followings->first()->followable;
        // The latest based on the first
        $latest = $first->articles()->with('author')->released()->latest('released_at')->get();
        // The most commented --articles-- based on the first
        $commented = $first->articles()->released()->with('author', 'comments')->get()->filter(function($item) {
            return $item->comments->isEmpty() !== true;
        })->sortByDesc('comments')->values();
        // The popular --articles-- based on the first
        $popular = $first->articles()->released()->with('author', 'likes', 'comments')->get()->sort(function($a, $b) {
            if ($a->likes->count() === $b->likes->count()) {
                return 0;
            }
            return $a->views + $a->comments->count() < $b->views + $b->comments->count() ? -1 : 1;
        })->values();

        return view('subscriptions.index', [
            'followings'    =>  $followings,
            'first'         =>  $first,
            'latest'        =>  $latest,
            'commented'     =>  $commented,
            'popular'       =>  $popular,
        ])->with('subscriptionActive', 'active');
    }

    public function recommend()
    {
        return view('subscriptions.recommendation')->with('subscriptionActive', 'active');
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
