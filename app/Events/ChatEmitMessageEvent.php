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
     * 消息发送者（用户）的实例
     *
     * @var User
     */
    private $sender;

    /**
     * 消息接收者（用户）的实例
     *
     * @var User
     */
    private $recipient;

    /**
     * 发出的消息的实例
     *
     * @var OutgoingMessage
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param User $sender
     * @param User $recipient
     * @param OutgoingMessage $message
     */
    public function __construct(User $sender, User $recipient, OutgoingMessage $message)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;

        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        // Generate unique pair channel that just only for two of them
        $id = collect([$this->sender->id, $this->recipient->id])->sort()->implode('-');
        return ['chat-with.' . $id];
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
