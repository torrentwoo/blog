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

    public $comment;
    public $recipient;
    public $message = [
        'type'  =>  'comment',
    ];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $recipient, array $message)
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
