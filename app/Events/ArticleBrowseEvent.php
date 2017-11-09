<?php

namespace App\Events;

use App\Events\Event;
use App\Models\Article;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleBrowseEvent extends Event
{
    use SerializesModels;

    /**
     * 文章模型
     *
     * @var Article
     */
    public $article;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Article $article
     * @return void
     */
    public function __construct(Article $article)
    {
        return $this->article = $article;
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
