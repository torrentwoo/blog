@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column.show', $article->column->id) }}">{{ $article->column->name }}</a></li>
                    <li><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></li>
                    <li class="active">评论</li>
                </ol>
                <div class="row">
                    <div id="comments" class="col-xs-12">
                        <ul class="media-list">
@foreach ($comments as $comment)
                            <li class="media" id="mark-{{ $comment->id }}">
                                <div class="media-left">
                                    <a href="{{ route('user.show', $comment->commentator->id) }}">
                                        <img alt="{{ $comment->commentator->name }}" class="media-object img-circle avatar-sm" src="{{ $comment->commentator->gravatar(48) }}" />
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="h4 media-heading">{{ $comment->commentator->name }}<small class="offset-right">{{ $comment->created_at->diffForHumans() }}</small></p>
                                    <p>{{ $comment->content }}</p>
@can ('comment', $article->author)
                                    <ul class="list-inline">
                                        <li>
                                            <form method="POST" action="#"><!-- vote up -->
                                                {{ csrf_field() }}
                                                <button type="button" class="btn btn-default btn-xs">
                                                    <i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i><!--20人-->赞
                                                </button>
                                            </form>
                                        </li>
@can ('comment', $comment->commentator)
                                        <li>
                                            <button type="button" class="btn btn-default btn-xs btn-reply" data-toggle="#reply-form{{ $comment->id }}">
                                                <i class="glyphicon glyphicon-retweet" aria-hidden="true"></i>回复
                                            </button>
                                        </li>
@endcan
                                    </ul>
@can ('comment', $comment->commentator)
                                    <div class="reply-form" id="reply-form{{ $comment->id }}">
                                        @include('features.builtIn-alert')

                                        <form method="POST" action="{{ route('comment.reply', $comment->id) }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <textarea name="reply" class="form-control" rows="3" placeholder="请在此写下您的回复"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="button" class="btn btn-default btn-sm offset-left" data-toggle="#reply-form{{ $comment->id }}">取消</button>
                                                <button type="submit" class="btn btn-primary btn-sm">回复评论</button>
                                            </div>
                                        </form>
                                    </div>
@endcan
@endcan
@if ($comment->replies->isEmpty() !== true)
                                    @include('features.nested-comment', ['replies' => $comment->replies])
@endif
                                </div>
                            </li>
@endforeach
                        </ul>
                    </div>

                    <div class="col-xs-12 text-center">
                        <nav aria-label="Page navigation">
                            {!! $comments->render() !!}
                        </nav>
                    </div>

@can ('comment', $article->author)
                    <div class="col-xs-12">
                        @include('features.comment-form')
                    </div>
@endcan
                </div>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">热门评论文章</h5>
                    </div>
                    <div class="list-group">
@forelse ($popular as $article)
                        <a class="list-group-item" href="{{ route('article.show', $article->id) }}">{{ str_limit($article->title, 24) }}<span class="badge" title="评论数量：{{ $article->comments->count() }}">{{ $article->comments->count() }}</span></a>
@empty
                        <p class="list-group-item">暂未出现热门评论文章</p>
@endforelse
                    </div>
                </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $('.btn-reply').bind('click', function() {
            var $btn = $(this);
            var $src = $btn.data('src');
            var $url = $btn.data('url');
            var $template = $('<div class="appendage" style="margin-top:1em;">' +
                '<div class="alert alert-danger" id="reply-alert' + $src + '" style="display:none;" role="alert"></div>' +
                '<div class="form-group"><textarea name="reply" id="reply-control' + $src + '" class="form-control" rows="3" placeholder="请在此写下您的回复"></textarea></div>' +
                '<div class="form-group"><button type="button" class="btn btn-primary" data-man="#reply-alert' + $src + '" data-hook="#reply-control' + $src + '" data-post="' + $url + '">回复评论</button></div>' +
                '</div>');
            var $wrap = $('#mark-' + $src + '-body');
            //console.log($wrap.children('.appendage').length);
            //$('div.appendage').remove();
            if ($wrap.children('.appendage').length) {
                $wrap.children('.appendage').remove();
            } else {
                $template.appendTo($wrap);
            }
        });
        $('.media-body').on('click', 'button[data-hook][data-post]', function() {
            var $this = $(this);
            var $url = $this.data('post');
            var $textarea = $($this.data('hook'));
            var $content = $textarea.val();
            var $alert = $($this.data('man'));
            if ($.trim($content).length < 15) {
                $alert.text('回复内容 至少为 15 个字符').show();
            } else {
                $alert.text('').hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $url,
                    type: 'POST',
                    data: {
                        'reply': $content
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (!response.error) {
                            //window.location.reload();
                            $('.media-body .appendage').remove();
                            //console.log(response.data.commentator);
                            $html = $('<div class="media">' +
                                '<div class="media-left">' +
                                '<a href="' + response.data.url + '">' +
                                '<img class="media-object img-circle avatar-sm" src="' + response.data.avatar + '" />' +
                                '</a>' +
                                '</div>' +
                                '<div class="media-body">' +
                                '<h4 class="media-heading">' + response.data.commentator + '<small class="offset-right">' + response.data.datetime + '</small></h4>' +
                                '<p>' + response.data.reply + '</p>' +
                                '</div>' +
                                '</div>');
                            $html.appendTo($('#mark-' + response.data.id + '-body'));
                        } else { // output error messages
                            $alert.text(response.message).show();
                        }
                    }
                });
            }
        });
    </script>
@stop