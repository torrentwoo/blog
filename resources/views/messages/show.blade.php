@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>站内信<small class="offset-right">与 {{ $import->name }} 的会话</small>
                                <a class="offset-right header-back" href="{{ route('message.index') }}">
                                    <i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>返回
                                </a>
                            </h1>
                        </div>
                        <div class="dialog-box">
@foreach ($messages as $message)
@if ($message->sender->id === $import->id)
                            <div class="dialog-import">
                                <div class="dialog-content">
                                    <img class="img-circle avatar-xs dialog-avatar" src="{{ $message->sender->gravatar(32) }}" />
                                    <div class="well dialog-message">{{ $message->content }}</div>
                                    <small class="text-muted">{{ $message->created_at->format('n/j g:i a') }}</small>
                                </div>
                            </div>
@else
                            <div class="dialog-export">
                                <div class="dialog-content">
                                    <img class="img-circle avatar-xs dialog-avatar" src="{{ $message->sender->gravatar(32) }}" />
                                    <div class="well dialog-message">{{ $message->content }}</div>
                                    <small class="dialog-timestamp text-muted">{{ $message->created_at->format('n/j g:i a') }}</small>
                                </div>
                            </div>
@endif
@endforeach
                        </div>
@can ('message', $import)
                        <div class="dialog-form">
                            <form id="chat-message" method="POST" action="{{ route('message.send', $import->id) }}">
                                @include('features.builtIn-alert')

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea name="message" class="form-control" rows="3" placeholder="请在此输入站内信"></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary" id="send-message">
                                        <i class="glyphicon glyphicon-send" aria-hidden="true"></i>发送
                                    </button>
                                </div>
                            </form>
                        </div>
@endcan
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
    <script type="text/javascript" src="/assets/js/socket.io-2.0.4.js"></script>
    <script type="text/javascript">
        $(function() {
            //
        })
    </script>
@stop