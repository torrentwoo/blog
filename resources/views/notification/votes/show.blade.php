@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的点赞<small class="offset-right">详情</small>
                                <a class="offset-right header-back" href="{{ route('notification.vote') }}">
                                    <i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>返回
                                </a>
                            </h1>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li><img class="img-circle avatar-xs" src="{{ $notification->notifiable->voter->gravatar(32) }}" /></li>
                                <li>{{ $notification->notifiable->voter->name }}</li>
                                <li>点赞了您的评论</li>
                                <li class="small text-muted">{{ $notification->notifiable->created_at->format('Y-m-d g:i a') }}</li>
                            </ul>
                            <p>{{ $notification->notifiable->votable->content }}</p>
                            <blockquote class="small text-muted">
@if ($notification->notifiable->votable->commentable_type === App\Models\Article::class)
                                <h4><a href="{{ route('article.show', $notification->notifiable->votable->commentable->id) }}">{{ $notification->notifiable->votable->commentable->title }}</a></h4>
                                <p>{{ $notification->notifiable->votable->commentable->description }}</p>
                                <p class="small">{{ $notification->notifiable->votable->commentable->author->name }}</p>
@elseif ($notification->notifiable->votable->commentable_type === App\Models\Comment::class)
                                <p>{{ $notification->notifiable->votable->commentable->content }}</p>
                                <p class="small">
                                    <a href="{{ route('user.show', $notification->notifiable->votable->commentator->id) }}">{{ $notification->notifiable->votable->commentator->name }}</a>
                                    <span class="offset-left offset-right">评论自</span>
                                    <a href="#">某一篇文章</a><!-- @TODO get the article, user home activities also has the same problem -->
                                </p>
@endif
                            </blockquote>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop