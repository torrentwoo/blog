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
                                <div class="alert alert-danger" role="alert">
                                    <i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>
                                    <span class="sr-only">错误：</span>
                                    <span class="alert-response"></span>
                                </div>
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
            // Avatars
            var recipientAvatar = '{{ $import->gravatar(32) }}';
            var myselfAvatar = '{{ Auth::user()->gravatar(32) }}';
            // Primary dialog box
            var $dialog = $('div.dialog-box');
            animation($dialog);
            // Send message and show outgoing message
            $('#chat-message').bind('submit', function(e) {
                var e = e ? e : (window.event.returnValue = false);
                e.preventDefault(); // prevent default event

                var form = $(this), url = form.prop('action');
                var alarm = $('div.alert', form), alarmText = $('span.alert-response', form);
                var $message = $('textarea[name="message"]', form);
                if (!$.trim($message.val()).length) {
                    alarm.show().find(alarmText).text('站内信 的内容不可为空');
                    return false;
                }
                if ($message.val().length > 140) {
                    alarm.show().find(alarmText).text('站内信 的内容不能大于 140 个字符');
                    return false;
                }
                alarm.hide().find(alarmText).text('');

                // Send message via Ajax
                $.post(url, {
                    '_method': 'POST',
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'message': $message.val()
                }, function(response) {
                    if (response.error !== true) {
                        alarm.hide(); // hide error alert
                        $message.val('');
                        // Show outgoing message
                        $('<div class="dialog-export"><div class="dialog-content">' +
                            '<img class="img-circle avatar-xs dialog-avatar" src="' + myselfAvatar + '" />' +
                            '<div class="well dialog-message">' + response.outgoingMessage + '</div>' +
                            '<small class="dialog-timestamp text-muted">' + response.delivered + '</small>' +
                            '</div>' +
                            '</div>').appendTo($dialog);
                        // Force to show the latest message
                        animation($dialog);
                    }
                }, 'json');
            });
            // Receive message and show received message
            var socket = io('{{ env('APP_URL') }}:3000'); // Keep same with the server that defined at chat-socket.js, which is driven by Node.js
            var unique = '{{ collect([$import->id, Auth::id()])->sort()->implode('-') }}';
            var myself = parseInt('{{ Auth::id() }}');
            socket.on('chat-with.' + unique + ':app.chat', function(data) {
                //console.log(data);
                if (data.dialog.from_id != myself) {
                    $('<div class="dialog-import">\n' +
                        '<div class="dialog-content">\n' +
                        '<img class="img-circle avatar-xs dialog-avatar" src="' + recipientAvatar + '" />\n' +
                        '<div class="well dialog-message">' + data.dialog.content + '</div>\n' +
                        '<small class="text-muted">' + data.datetime + '</small>\n' +
                        '</div>\n' +
                        '</div>').appendTo($dialog);
                    // When new message comes in, automatic scroll to bottom
                    animation($dialog);
                }
            });
        });
        var animation = function(o) {
            o.animate({
                scrollTop: o[0].scrollHeight
            }, 400);
        };
    </script>
@stop