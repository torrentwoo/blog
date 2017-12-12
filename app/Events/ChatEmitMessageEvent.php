<?php

namespace App\Events;

use App\Events\Event;
use App\Models\OutgoingMessage;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatEmitMessageEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * 消息接收者（用户）的实例
     *
     * @var User
     */
    public $user;

    /**
     * 发出的消息的实例
     *
     * @var OutgoingMessage
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param User $recipient
     * @param OutgoingMessage $message
     */
    public function __construct(User $recipient, OutgoingMessage $message)
    {
        $this->user = $recipient;
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['chat-with:' . $this->user->id];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'app.chat';
    }
}
