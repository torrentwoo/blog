<?php

namespace App\Listeners;

use App\Events\UserLoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoginEvent  $event
     * @return void
     */
    public function handle(UserLoginEvent $event)
    {
        //
    }

    /**
     * 注册事件订阅器
     * 事件订阅器是一个让你可以订阅多个事件的类，允许你在单个类内定义多个事件的操作
     *
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('App\Events\UserLoginEvent', 'App\Listeners\UserEventListener@onUserLogin');
    }

    /**
     * 处理用户登录事件
     *
     * @param \App\Events\UserLoginEvent $event
     */
    public function onUserLogin($event)
    {
        $event->user->update([
            'last_login_ip' =>  $event->ip, // 更新登录的 ip 地址
        ]);
    }
}
