@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>被关注<small class="offset-right">详情</small>
                                <a class="offset-right header-back" href="{{ route('notification.follow') }}">
                                    <i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>返回
                                </a>
                            </h1>
                        </div>
                        <div class="well well-quirk">
                            <ul class="list-inline">
                                <li><img class="img-circle avatar-xs" src="{{ $notification->notifiable->holder->gravatar(32) }}" /></li>
                                <li>{{ $notification->notifiable->holder->name }}</li>
                                <li>关注了您</li>
                                <li class="small text-muted">{{ $notification->notifiable->created_at->format('Y-m-d g:i a') }}</li>
                            </ul>
                            <blockquote class="small text-muted">
                                <div class="well media">
                                    <div class="media-left">
                                        <a href="{{ route('users.show', $notification->notifiable->holder->id) }}">
                                            <img class="media-object img-circle avatar-sm" src="{{ $notification->notifiable->holder->gravatar(48) }}" />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $notification->notifiable->holder->name }}</h4>
                                        <p class="text-muted">发布了 {{ $notification->notifiable->holder->articles->count() }} 篇文章，被 {{ $notification->notifiable->holder->followingUsers->count() }} 人关注，获得 {{ $notification->notifiable->holder->likedUsers()->count() }} 个喜欢</p>
                                    </div>
@if ($notification->notifiable->holder->introduction)
                                    <div class="media-bottom text-muted">{{ $notification->notifiable->holder->introduction }}</div>
@endif
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop