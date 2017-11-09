<?php

namespace App\Listeners;

use App\Events\ArticleBrowseEvent;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class ArticleEventListener
{
    /**
     * 会话
     *
     * @var Store
     */
    protected $session;

    /**
     * Http 请求实例
     * 主要使用到其中获取客户端 ip 地址的方法
     *
     * @var Request
     */
    protected $request;

    /**
     * Create the event listener.
     *
     * @param \Illuminate\Session\Store $session
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Store $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleBrowseEvent  $event
     * @return void
     */
    public function handle(ArticleBrowseEvent $event)
    {
        //
    }

    /**
     * 利用事件订阅器注册事件和与之对应的监听器（的方法）
     * 利用事件订阅器的特性，我们可以在单个监听器内订阅多个事件（的类），即用一个监听器监听多各事件
     *
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('App\Events\ArticleBrowseEvent', 'App\Listeners\ArticleEventListener@onArticleBrowse');
    }

    /**
     * 处理文章浏览事件
     *
     * @param \App\Events\ArticleBrowseEvent $event
     */
    public function onArticleBrowse($event)
    {
        $article = $event->article;
        if ($this->hasBrowsed($article)) {
            $article->update([
                'visited'   =>  $article->visited + 1
            ]);
            $this->storeBrowsed($article);
        }
    }

    protected function hasBrowsed($article)
    {
        return array_key_exists($article->id, $this->getBrowsed());
    }

    protected function getBrowsed()
    {
        return $this->session->get('browsedArticle', []);
    }

    protected function storeBrowsed($article)
    {
        $key = "browsedArticle{$article->id}";
        $this->session->put($key, \Carbon\Carbon::now());
    }
}
