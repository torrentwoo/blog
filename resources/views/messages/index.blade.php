@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>站内信<small class="offset-right">全部</small></h1>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12" id="message-container">
@forelse ($messages as $index => $message)
                        <div class="media media-quirk" id="message{{ $index }}">
                            <div class="media-left">
                                <img class="media-object img-circle avatar-sm" src="{{ $message->first()->sender->gravatar(48) }}" />
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading h4">{{ $message->first()->sender->name }}
                                    <small class="offset-right">{{ $message->max('created_at')->format('Y-m-d g:i a') }}</small>
@if ($message->where('read', 0)->count() > 0)
                                    <small class="offset-right"><span class="badge">{{ $message->where('read', 0)->count() }}</span></small>
@endif
                                </h3>
                                <p class="text-muted">{{ $message->last()->content }}</p>
                            </div>
                            <div class="media-right">
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="btn btn-xs" id="dropdownMenu{{ $index }}" data-toggle="dropdown" role="button">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                        <span class="sr-only">操作：</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $index }}">
                                        <li><a class="caution bg-primary" href="{{ route('message.show', $message->first()->sender->id) }}"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>回复</a></li>
                                        <li><a class="caution bg-danger" href="javascript:void(0);" data-target="#message{{ $index }}" data-handler="{{ route('message.delete', $message->first()->sender->id) }}" data-chat="{{ $message->first()->sender->name }}"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>删除对话</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a class="caution bg-danger" href="#blacklist-{{ $message->first()->sender->id }}"><i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>加入黑名单</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
@empty
@forelse ($outgoing as $index => $message)
                        <div class="media media-quirk" id="message-outgoing{{ $index }}">
                            <div class="media-left">
                                <img class="media-object img-circle avatar-sm" src="{{ $message->first()->recipient->gravatar(48) }}" />
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading h4">{{ $message->first()->recipient->name }}
                                    <small class="offset-right">{{ $message->max('created_at')->format('Y-m-d g:i a') }}</small>
@if ($message->where('read', 0)->count() > 0)
                                    <small class="offset-right"><span class="badge">{{ $message->where('read', 0)->count() }}</span></small>
@endif
                                </h3>
                                <p class="text-muted">{{ $message->last()->content }}</p>
                            </div>
                            <div class="media-right">
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="btn btn-xs" id="dropdownMenu{{ $index }}" data-toggle="dropdown" role="button">
                                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                                        <span class="sr-only">操作：</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $index }}">
                                        <li><a class="caution bg-primary" href="{{ route('message.show', $message->first()->recipient->id) }}"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>回复</a></li>
                                        <li><a class="caution bg-danger" href="javascript:void(0);" data-target="#message-outgoing{{ $index }}" data-handler="{{ route('message.delete', $message->first()->recipient->id) }}" data-chat="{{ $message->first()->recipient->name }}"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>删除对话</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a class="caution bg-danger" href="#blacklist-{{ $message->first()->recipient->id }}"><i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>加入黑名单</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有收到任何站内信</p>
                        </div>
@endforelse
@endforelse
                    </div>
                </div>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="list-group">
                        <a href="{{ route('message.index') }}" class="list-group-item active">站内信</a>
                        <a href="{{ route('notification.comment') }}" class="list-group-item">评论</a>
                        <a href="{{ route('notification.request') }}" class="list-group-item">投稿邀约</a>
                        <a href="{{ route('notification.vote') }}" class="list-group-item">点赞</a>
                        <a href="{{ route('notification.like') }}" class="list-group-item">喜欢</a>
                        <a href="{{ route('notification.follow') }}" class="list-group-item">关注</a>
                        <a href="{{ route('notification.reward') }}" class="list-group-item">赞赏</a>
                        <a href="{{ route('notification.others') }}" class="list-group-item">其他</a>
                    </div>
                </div>
@stop

@section('scripts')
    <script type="text/javascript" src="/assets/js/app-chatNotification.js"></script>
@stop