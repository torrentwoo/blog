<?php

namespace App\Events;

use App\Events\Event;
use App\Models\ReceivedMessage;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * 消息发送者（用户）的实例
     *
     * @var User
     */
    public $from;

    /**
     * 消息接收者（用户）的实例
     *
     * @var User
     */
    private $recipient;

    /**
     * 收到的消息的实例
     *
     * @var ReceivedMessage
     */
    public $message;

    /**
     * 已经格式化的消息发送的日期时间
     *
     * @var string
     */
    public $delivered;

    /**
     * Create a new event instance.
     *
     * @param User $from
     * @param User $recipient
     * @param ReceivedMessage $message
     */
    public function __construct(User $from, User $recipient, ReceivedMessage $message)
    {
        $this->from = $from;
        $this->recipient = $recipient;

        $this->message = $message;
        $this->delivered = $message->created_at->format('n/j g:i a');
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['message-to.' . $this->recipient->id];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'app.chatMessage';
    }
}
