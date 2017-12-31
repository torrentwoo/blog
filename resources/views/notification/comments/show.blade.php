@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的评论<small class="offset-right">{{ $notification->notifiable->commentator->name }} 的评论</small>
                                <a class="offset-right header-back" href="{{ route('notification.comment') }}">
                                    <i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>返回
                                </a>
                            </h1>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li><img class="img-circle avatar-xs" src="{{ $notification->notifiable->commentator->gravatar(32) }}" /></li>
                                <li>{{ $notification->notifiable->commentator->name }}</li>
@if ($notification->notifiable_type === App\Models\Comment::class)
                                <li>评论了您的文章</li>
@else
                                <li>回复了您的评论</li>
@endif
                                <li class="small text-muted">{{ $notification->notifiable->created_at->format('Y-m-d g:i a') }}</li>
                            </ul>
                            <p>{{ $notification->notifiable->content }}</p>
                            <blockquote class="small text-muted">
                                <h4><a href="{{ route('articles.show', $notification->notifiable->commentable->id) }}">{{ $notification->notifiable->commentable->title }}</a></h4>
                                <p>{{ $notification->notifiable->commentable->description }}</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop