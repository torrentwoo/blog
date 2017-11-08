<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserLoginEvent extends Event
{
    use SerializesModels;

    /**
     * 用户模型
     *
     * @var User
     */
    protected $user;

    /**
     * 时间戳
     *
     * @var Carbon
     */
    protected $timestamp;

    /**
     * 客户端 ip 地址
     *
     * @var string
     */
    protected $ip;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param \Carbon\Carbon   $timestamp
     * @param string           $ip          the value of client ip address
     * @return void
     */
    public function __construct(User $user, Carbon $timestamp, $ip)
    {
        $this->user = $user;
        $this->timestamp = $timestamp;
        $this->ip = $ip;
    }

    /**
     * 获取当前类中的某些属性的值
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
