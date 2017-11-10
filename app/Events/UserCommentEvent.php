<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCommentEvent extends Event
{
    use SerializesModels;

    /**
     * 用户模型
     *
     * @var User
     */
    public $user;

    /**
     * 评论模型
     *
     * @var Comment
     */
    public $comment;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Comment $comment
     * @return void
     */
    public function __construct(User $user, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
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
