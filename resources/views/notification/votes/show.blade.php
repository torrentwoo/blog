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
                            <p>{{ $notification->notifiable->content }}</p>
                            <blockquote class="small text-muted">
                                <h4><a href="{{ route('article.show', $notification->notifiable->commentable->id) }}">{{ $notification->notifiable->commentable->title }}</a></h4>
                                <p>{{ $notification->notifiable->commentable->description }}</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop