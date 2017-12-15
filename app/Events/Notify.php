<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notify extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * 用户的实例（站内通知的接收者）
     *
     * @var User
     */
    private $recipient;

    /**
     * 是否有新的站内通知的标记
     *
     * @var bool
     */
    public $hasNotification = false;

    /**
     * Create a new event instance.
     *
     * @param User $recipient
     */
    public function __construct(User $recipient)
    {
        $this->recipient = $recipient;
        $this->hasNotification = true;
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
        return 'app.notification';
    }
}
