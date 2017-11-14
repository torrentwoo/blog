@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">用户</a></li>
                    <li class="active">我的文章</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
@foreach ($favorites as $article)
                        <dl class="well my-moment">
                            <dt><a href="{{ route('article', $article->id) }}" target="_blank">{{ $article->title }}</a></dt>
                            <dd class="occurred">
                                <small class="text-muted">
                                    <ul class="list-inline">
                                        <li>创建于：{{ $article->created_at->format('Y-m-d H:i') }}</li>
                                        <li>阅读：{{ $article->views }}</li>
                                        <li>评论：{{ $article->comments->count() }}</li>
                                        <li>喜欢：{{ $article->favorites->count() }}</li>
                                    </ul>
                                </small>
                            </dd>
                            <dd>{{ $article->description }}</dd>
                        </dl>
@endforeach
                    </div>
                </div>
                <nav class="clearfix text-center" aria-label="Page navigation">
                    {!! $favorites->render() !!}
                </nav>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">我的综合评价最高的文章</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item" href="#">Testing</a>
                    </div>
                </div>
@stop