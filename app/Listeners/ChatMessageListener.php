<?php

namespace App\Listeners;

use App\Events\ChatEmitMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChatMessageListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatEmitMessageEvent  $event
     * @return void
     */
    public function handle(ChatEmitMessageEvent $event)
    {
        //
    }
}
