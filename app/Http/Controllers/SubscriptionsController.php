<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\User;
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

    protected function retrieve($origin = null)
    {
        // The following list
        $followings = Auth::user()->follows()->latest('created_at')->get();
        if ($followings->isEmpty()) {
            $origin = $latest = $commented = $popular = [];
        } else {
            if (true !== isset($origin)) { // instance of Column or User
                $origin = $followings->first()->followable;
            }
            // The latest articles
            $latest = $origin->articles()->released()->with('author')->latest('released_at')->get();
            // The most commented articles
            $commented = $origin->articles()->released()->with('author', 'comments')->get()->filter(function ($item) {
                return $item->comments->isEmpty() !== true;
            })->sortByDesc('comments')->values();
            // The popular articles
            $popular = $origin->articles()->released()->with('author', 'likes', 'comments')->get()->sort(function ($a, $b) {
                if ($a->likes->count() === $b->likes->count()) {
                    return 0;
                }
                return $a->views + $a->comments->count() < $b->views + $b->comments->count() ? -1 : 1;
            })->values();
        }

        return [
            'followings'    =>  $followings,
            'origin'        =>  $origin,
            'latest'        =>  $latest,
            'commented'     =>  $commented,
            'popular'       =>  $popular,
        ];
    }

    public function index()
    {
        $data = $this->retrieve();

        return view('subscriptions.index', $data)->with('subscriptionActive', 'active');
    }

    public function recommend()
    {
        return view('subscriptions.recommendation')->with('subscriptionActive', 'active');
    }

    public function followingColumn($id)
    {
        // The specified column
        $origin = Column::visible()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.column', $data)->with('subscriptionActive', 'active');
    }

    public function followingUser($id)
    {
        // The specified user
        $origin = User::activated()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.user', $data)->with('subscriptionActive', 'active');
    }
}
