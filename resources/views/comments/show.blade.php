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
                                            <button type="button" class="btn btn-default btn-xs btn-vote{{ in_array(Auth::id(), $comment->votes->pluck('user_id')->all()) ? ' active' : null }}" data-handler="{{ route('vote.up', $comment->id) }}">
                                                <i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i><span class="vote-result{{ $comment->votes()->withType('up')->count() > 0 ? ' vote-result-active' : null }}"><span class="vote-amount">{{ $comment->votes()->withType('up')->count() }}</span>人</span>赞
                                            </button>
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
                                    <div class="reply-form reply-form-hidden" id="reply-form{{ $comment->id }}">
                                        <div class="alert alert-danger" role="alert">
                                            <i class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></i>
                                            <span class="sr-only">错误：</span>
                                            <span class="alert-response"></span>
                                        </div>
                                        <form method="POST" action="{{ route('comment.reply', $comment->id) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="articleId" value="{{ $article->id }}" />
                                            <div class="form-group">
                                                <textarea name="reply" class="form-control" rows="3" placeholder="请在此写下您的回复" aria-required="true"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="button" class="btn btn-default btn-sm offset-left" data-toggle="#reply-form{{ $comment->id }}">取消</button>
                                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="#reply-form{{ $comment->id }}">回复评论</button>
                                            </div>
                                        </form>
                                    </div>
@endcan
@endcan
@if ($comment->replies->isEmpty() !== true)
                                    @include('features.nested-comment', ['replies' => $comment->replies, 'article' => $article])
@endif
                                </div>
                            </li>
@endforeach
                        </ul>
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
        $(function() {
            $('.btn-reply').bind('click', function() {
                var $btn = $(this);
                var $form = $($btn.data('toggle'));
                $('.reply-form').addClass('reply-form-hidden').filter($form).toggleClass('reply-form-active');
                $('div.alert', $form).hide();
            });
            // Revoke
            $('.reply-form').on('click', 'button[type="button"][data-toggle]', function() {
                var $form = $($(this).data('toggle'));
                $('.reply-form').addClass('reply-form-hidden').filter($form).removeClass('reply-form-active');
                $('div.alert', $form).hide();
            });
            // Submit
            $('.reply-form').on('click', 'button[type="submit"][data-toggle]', function() {
                var $form = $($(this).data('toggle'));
                var $alarm = $('div.alert', $form);
                var $response = $('span.alert-response', $form);
                var $reply = $('textarea[name="reply"]', $form);
                if (!$.trim($reply.val()).length) {
                    $alarm.show().find($response).text('回复内容 不能为空');
                    return false;
                }
                if ($reply.val().length < 15) {
                    $alarm.show().find($response).text('回复内容 至少为 15 个字符');
                    return false;
                }
                if ($reply.val().length > 140) {
                    $alarm.show().find($response).text('回复内容 不能大于 140 个字符');
                    return false;
                }
            });
            // Vote: give the thumbs-up
            $('.btn-vote').bind('click', function() {
                $btn = $(this);
                $url = $btn.data('handler');
                $result = $('.vote-result', $btn);
                $amount = $('.vote-amount', $btn);
                $number = parseInt($amount.text(), 10) || 0; // number

                if ($btn.hasClass('active') !== true) { // vote
                    $.post($url, {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    }, function(response) {
                        if (!response.error) {
                            $btn.addClass('active');
                            $amount.text($number + 1);
                            $result.addClass('vote-result-active');
                        }
                    }, 'json');
                } else { // revoke a vote
                    $.post($url, {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        '_method': 'DELETE'
                    }, function(response) {
                        if (!response.error) {
                            $btn.removeClass('active');
                            $amount.text($number - 1);
                            if (0 >= ($number - 1)) {
                                $result.removeClass('vote-result-active');
                            }
                        }
                    }, 'json');
                }
            });
        })
    </script>
@stop