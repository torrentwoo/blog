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
                                <h4><a href="{{ route('articles.show', $notification->notifiable->votable->commentable->id) }}">{{ $notification->notifiable->votable->commentable->title }}</a></h4>
                                <p>{{ $notification->notifiable->votable->commentable->description }}</p>
                                <ul class="list-inline small">
                                    <li><a href="{{ route('users.show', $notification->notifiable->votable->commentable->author->id) }}">{{ $notification->notifiable->votable->commentable->author->name }}</a></li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $notification->notifiable->votable->commentable->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $notification->notifiable->votable->commentable->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.comments.index', $notification->notifiable->votable->commentable->id) }}">
                                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                            <span class="sr-only">评论：</span>
                                            {{ $notification->notifiable->votable->commentable->comments->count() }}
                                        </a>
                                    </li>
                                    <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                        <span class="sr-only">喜欢：</span>
                                        {{ $notification->notifiable->votable->commentable->likes->count() }}
                                    </li>
                                </ul>
@elseif ($notification->notifiable->votable->commentable_type === App\Models\Comment::class)
                                <p>{{ $notification->notifiable->votable->commentable->content }}</p>
                                <p class="small">
                                    <a href="{{ route('users.show', $notification->notifiable->votable->commentator->id) }}">{{ $notification->notifiable->votable->commentator->name }}</a>
                                    <span class="offset-left offset-right">评论自</span>
                                    <a href="{{ route('articles.comments.index', $notification->notifiable->votable->topmostComment()->commentable_id) }}#mark-{{ $notification->notifiable->votable->topmostComment()->id }}">{{ $notification->notifiable->votable->topmostComment()->commentable->title }}</a>
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