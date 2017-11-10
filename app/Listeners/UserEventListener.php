<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Carbon\Carbon
     */
    protected $carbon;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Carbon\Carbon $carbon
     */
    public function __construct(Request $request, Carbon $carbon)
    {
        $this->request = $request;
        $this->carbon = $carbon;
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * 利用事件订阅器注册事件和与之对应的监听器（的方法）
     * 利用事件订阅器的特性，我们可以在单个监听器内订阅多个事件（的类），即用一个监听器监听多个事件（不再需要 handle 方法）
     *
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('App\Events\UserLoginEvent', 'App\Listeners\UserEventListener@onUserLogin');
        $event->listen('App\Events\UserCommentEvent', 'App\Listeners\UserEventListener@onUserComment');
    }

    /**
     * 处理用户登录事件
     *
     * @param \App\Events\UserLoginEvent $event
     */
    public function onUserLogin($event)
    {
        $event->user->update([
            'last_login_ip' =>  $this->request->ip(), // 更新用户登录时所在的 IP 地址
        ]);
    }

    /**
     * 处理用户评论事件
     *
     * @param \App\Events\UserCommentEvent $event
     */
    public function onUserComment($event)
    {
        //
    }
}
