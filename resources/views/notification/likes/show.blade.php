@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的喜欢<small class="offset-right">详情</small>
                                <a class="offset-right header-back" href="{{ route('notification.like') }}">
                                    <i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>返回
                                </a>
                            </h1>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li><img class="img-circle avatar-xs" src="{{ $notification->notifiable->liker->gravatar(32) }}" /></li>
                                <li>{{ $notification->notifiable->liker->name }}</li>
                                <li>喜欢了您的文章</li>
                                <li class="small text-muted">{{ $notification->notifiable->created_at->format('Y-m-d g:i a') }}</li>
                            </ul>
                            <blockquote class="small text-muted">
                                <h4><a href="{{ route('article.show', $notification->notifiable->likable->id) }}">{{ $notification->notifiable->likable->title }}</a></h4>
                                <p>{{ $notification->notifiable->likable->description }}</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop