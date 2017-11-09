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

    protected $sessionArticleBrowsedPrefixKey;

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
        $this->sessionArticleBrowsedPrefixKey = 'browsedArticle-';
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
     * 利用事件订阅器的特性，我们可以在单个监听器内订阅多个事件（的类），即用一个监听器监听多个事件
     *
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('App\Events\ArticleBrowseEvent', 'App\Listeners\ArticleEventListener@onArticleBrowse');
    }

    /**
     * 处理文章浏览事件
     * 实现文章的浏览次数统计
     *
     * @param \App\Events\ArticleBrowseEvent $event
     */
    public function onArticleBrowse($event)
    {
        $article = $event->article;
        if (!$this->hasBrowsed($article)) {
            $article->update([
                'views'   =>  $article->views + 1
            ]);
            $this->storeBrowsed($article);
        }
    }

    /**
     * 查询 session 数据，是否有记录文章的浏览数据
     *
     * @param \App\Models\Article $article
     * @return bool
     */
    protected function hasBrowsed($article)
    {
        return $this->session->has("{$this->sessionArticleBrowsedPrefixKey}{$article->id}");
    }

    /**
     * 保存浏览记录数据到 session 当中
     *
     * @param \App\Models\Article $article
     * @return void
     */
    protected function storeBrowsed($article)
    {
        $this->session->put("{$this->sessionArticleBrowsedPrefixKey}{$article->id}", [
            'timestamp' =>  \Carbon\Carbon::now(),
            'slug'      =>  $article->id,
            'ip'        =>  $this->request->ip(),
        ]);
    }
}
