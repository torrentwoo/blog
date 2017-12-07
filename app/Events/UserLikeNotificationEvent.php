<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Like;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserLikeNotificationEvent extends Event
{
    use SerializesModels;

    /**
     * 喜欢的实例
     *
     * @var Like
     */
    public $like;

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
        'type'  =>  'like',
    ];

    /**
     * Create a new event instance.
     *
     * @param Like $like
     * @param User $recipient
     * @param array $message
     */
    public function __construct(Like $like, User $recipient, array $message = [])
    {
        $this->like = $like;
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
