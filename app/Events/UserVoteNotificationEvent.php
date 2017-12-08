<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserVoteNotificationEvent extends Event
{
    use SerializesModels;

    /**
     * 投票的实例
     *
     * @var Vote
     */
    public $vote;

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
        'type'  =>  'vote',
    ];

    /**
     * Create a new event instance.
     *
     * @param Vote $vote
     * @param User $recipient
     * @param array $message
     */
    public function __construct(Vote $vote, User $recipient, array $message = [])
    {
        $this->vote = $vote;
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
