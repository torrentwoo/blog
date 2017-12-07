<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCommentNotificationEvent extends Event
{
    use SerializesModels;

    /**
     * 评论的实例
     *
     * @var Comment
     */
    public $comment;

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
        'type'  =>  'comment',
    ];

    /**
     * Create a new event instance
     *
     * @param Comment $comment
     * @param User $recipient
     * @param array $message
     */
    public function __construct(Comment $comment, User $recipient, array $message = [])
    {
        $this->comment = $comment;
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
