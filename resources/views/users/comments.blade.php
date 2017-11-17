@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">用户</a></li>
                    <li class="active">我的评论</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
@forelse ($comments as $comment)
                        <dl class="well my-moment">
                            <dt><a href="{{ route('article.show', $comment->article_id) }}" target="_blank">{{ $comment->article->title }}</a></dt>
                            <dd class="occurred">
                                <small class="text-muted">
                                    <ul class="list-inline">
                                        <li>评论于：{{ $comment->created_at->format('Y-m-d H:i') }}</li>
                                        <li>总评论：{{ $comment->article->comments->count() }}</li>
                                    </ul>
                                </small>
                            </dd>
                            <dd>{{ $comment->content }}</dd>
                        </dl>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有发表过任何评论，不如先去本站的其他栏目逛逛，可能有您喜欢的内容哦</p>
                        </div>
@endforelse
                    </div>
                </div>
                <nav class="clearfix text-center" aria-label="Page navigation">
                    {!! $comments->render() !!}
                </nav>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">热门话题</h5>
                    </div>
                    <div class="list-group">
                        <p class="list-group-item">暂时还未出现热门话题，不如<a href="#">去创建一个</a></p>
                    </div>
                </div>
@stop