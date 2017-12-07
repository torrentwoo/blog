<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserFollowNotificationEvent extends Event
{
    use SerializesModels;

    /**
     * 关注的实例
     *
     * @var Follow
     */
    public $follow;

    /**
     * 通知接收者（用户）的实例
     *
     * @var User
     */
    public $recipient;

    /**
     * 通知消息的主体内容
     *
     * @var array
     */
    public $message = [
        'type'  =>  'follow',
    ];

    /**
     * Create a new event instance.
     *
     * @param Follow $follow
     * @param User $recipient
     * @param array $message
     */
    public function __construct(Follow $follow, User $recipient, array $message = [])
    {
        $this->follow = $follow;
        $this->recipient = $recipient;

        isset($message['subject']) && $this->message['subject'] = $message['subject'];
        isset($message['content']) && $this->message['content'] = $message['content'];
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
