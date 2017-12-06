@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的评论<small class="offset-right">全部</small></h1>
                        </div>
@forelse ($comments as $notification)
{{--
                        <div class="well well-quirk">
                            <ul class="list-inline">
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
                                <p>{{ $notification->notifiable->commentable->title }}</p>
                                <p>{{ $notification->notifiable->commentable->description }}</p>
                            </blockquote>
                        </div>
--}}
                        <div class="media media-quirk" id="notification{{ $notification->id }}">
                            <div class="media-left">
                                <img class="media-object img-circle avatar-sm" src="{{ $notification->notifiable->commentator->gravatar(48) }}" />
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading h4">{{ $notification->subject }}
                                    <small class="offset-right">{{ $notification->notifiable->created_at->format('Y-m-d g:i a') }}</small>
                                </h3>
                                <p class="text-muted">{{ $notification->content }}</p>
                            </div>
                            <div class="media-right">
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="btn btn-xs" id="dropdownMenu{{ $notification->id }}" data-toggle="dropdown" role="button">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                        <span class="sr-only">操作：</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $notification->id }}">
                                        <li><a class="caution bg-primary" href="{{ route('notification.showComment', $notification->id) }}"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>查看</a></li>
                                        <li><a class="caution bg-danger" href="javascript:void(0);" data-toggle="#notification{{ $notification->id }}" data-handler="{{ route('notification.deleteComment', $notification->id) }}"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>删除</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a class="caution bg-danger" href="#blacklist-{{ $notification->notifiable->commentator->id }}"><i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>加入黑名单</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有收到任何此类消息通知</p>
                        </div>
@endforelse
                        <nav class="text-center" aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="disabled">
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop