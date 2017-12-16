<?php

namespace App\Events;

use App\Events\Event;
use App\Models\ReceivedMessage;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatNotification extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $from = [
        'id' => '',
        'name' => '',
        'avatar' => '',
        'blacklist' => '',
    ];

    /**
     * 消息接收者（用户）的实例
     *
     * @var User
     */
    private $recipient;

    public $message = [
        'content' => '',
        'datetime' => '',
        'show' => '',
        'delete' => '',
    ];

    /**
     * Create a new event instance.
     *
     * @param User $from
     * @param User $recipient
     * @param ReceivedMessage $message
     */
    public function __construct(User $from, User $recipient, ReceivedMessage $message)
    {
        $this->from['id'] = $from->id;
        $this->from['name'] = $from->name;
        $this->from['avatar'] = $from->gravatar(32);
        $this->from['blacklistUrl'] = ''; // only accept a route

        $this->recipient = $recipient;

        $this->message['content'] = str_limit($message->content);
        $this->message['datetime'] = $message->created_at->format('Y-m-d g:i a');
        $this->message['show'] = route('message.show', $from->id);
        $this->message['delete'] = route('message.delete', $from->id);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notify-to.' . $this->recipient->id];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'app.chatNotification';
    }
}
