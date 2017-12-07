@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="page-header">
                            <h1>收到的评论<small class="offset-right">全部</small></h1>
                        </div>
@forelse ($comments as $notification)
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
                    </div>
                </div>
@stop

@section('sidebar')
                @include('notification.menu')
@stop

@section('scripts')
    <script type="text/javascript">
        $(function() {
            // Delete notification
            $('.media-quirk').on('click', 'a[data-toggle][data-handler]', function() {
                if (!confirm('是否确认删除这条通知消息')) {
                    return false;
                }
                var $btn = $(this);
                var $wrap = $($btn.data('toggle'));
                var $url = $btn.data('handler');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post($url, {
                    '_method': 'DELETE'
                }, function(response) {
                    if (!response.error) {
                        $wrap.remove();
                    } else {
                        window.alert(response.message);
                    }
                }, 'json');
            });
        });
    </script>
@stop