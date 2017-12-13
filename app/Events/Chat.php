<?php

namespace App\Events;

use App\Events\Event;
use App\Models\OutgoingMessage;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Chat extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * 参与对话的用户实例（对话发起者）
     *
     * @var User
     */
    private $one;

    /**
     * 参与对话的用户实例（对话接收者）
     *
     * @var User
     */
    private $other;

    /**
     * 消息的实例（由对话发起者发出的消息，实际也是对话被接收的内容）
     *
     * @var OutgoingMessage
     */
    public $dialog;

    /**
     * 已经被格式化的对话发生的日期时间
     *
     * @var string
     */
    public $datetime;

    /**
     * Create a new event instance.
     *
     * @param User $one
     * @param User $other
     * @param OutgoingMessage $message
     */
    public function __construct(User $one, User $other, OutgoingMessage $message)
    {
        $this->one = $one;
        $this->other = $other;

        $this->dialog = $message;
        $this->datetime = $message->created_at->format('n/j g:i a');
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        $pair = collect([$this->one->id, $this->other->id])->sort()->implode('-');
        return ['chat-with.' . $pair];
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
