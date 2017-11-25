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
    protected $followings;

    public function __construct()
    {
        $this->middleware('auth');
        // The data of user following list
        Auth::check() && $this->followings = Auth::user()->follows()->latest('created_at')->get();
    }

    protected function retrieve($origin = null)
    {
        if ($this->followings->isEmpty()) {
            $origin = $latest = $commented = $popular = [];
        } else {
            if (true !== isset($origin)) { // must be the instance of Column or User
                $origin = $this->followings->first()->followable;
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
            'followings'    =>  $this->followings,
            'origin'        =>  $origin,
            'latest'        =>  $latest,
            'commented'     =>  $commented,
            'popular'       =>  $popular,
        ];
    }

    /**
     * 响应对 GET /subscriptions 的请求
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if ($this->followings->isEmpty()) {
            return redirect()->route('subscription.recommend');
        } else {
            $data = $this->retrieve();

            return view('subscriptions.index', $data)->with('subscriptionActive', 'active');
        }
    }

    /**
     * 响应对 GET /subscriptions/recommendation 的请求
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recommend()
    {
        return view('subscriptions.recommendation', [
            'followings'    =>  $this->followings,
        ])->with('subscriptionActive', 'active');
    }

    /**
     * 显示某个被关注的栏目其可供订阅的内容
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followingColumn($id)
    {
        $origin = Column::visible()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.column', $data)->with('subscriptionActive', 'active');
    }

    /**
     * 显示某个被关注的用户其可供订阅的内容
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followingUser($id)
    {
        $origin = User::activated()->findOrFail($id);
        $data   = $this->retrieve($origin);

        return view('subscriptions.user', $data)->with('subscriptionActive', 'active');
    }
}
