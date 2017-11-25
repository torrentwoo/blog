<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        // Recommend authors
        $authors = User::activated()->with('articles', 'favoriteArticles', 'likedArticles')->get()->sort(function($a, $b) {
            $a1Amount = $a->articles->count();
            $a2Amount = $a->favoriteArticles->count();
            $a3Amount = $a->likedArticles->count();

            $b1Amount = $b->articles->count();
            $b2Amount = $b->favoriteArticles->count();
            $b3Amount = $b->likedArticles->count();

            switch (true) {
                case ($a3Amount === $b3Amount) :
                case ($a2Amount === $b2Amount) :
                case ($a1Amount === $b1Amount) :
                    return 0;
                    break;
                case ($a3Amount > $b3Amount) :
                case ($a2Amount > $b2Amount) :
                //case ($a1Amount > $b1Amount) :
                    return 1;
                    break;
                default :
                    return -1;
                    break;
            }
        })->values();
        // Recommend columns
        $columns = Column::visible()->with('articles', 'follows')->get()->sort(function($a, $b) {
            $a1Amount = $a->articles->count(); $a2Amount = $a->follows->count();
            $b1Amount = $b->articles->count(); $b2Amount = $b->follows->count();

            switch (true) {
                case ($a1Amount === $b1Amount) :
                //case ($a1Amount+$a2Amount === $b1Amount+$b2Amount) :
                    return 0;
                    break;
                case ($a1Amount > $b1Amount) :
                case ($a1Amount+$a2Amount > $b1Amount+$b2Amount) :
                    return 1;
                    break;
                default :
                    return -1;
                    break;
            }
        })->reverse()->values();

        return view('subscriptions.recommendation', [
            'followings'    =>  $this->followings,
            'authors'       =>  $authors,
            'columns'       =>  $columns,
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
