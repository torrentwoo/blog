@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">用户</a></li>
                    <li class="active">我的收藏</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
@forelse ($favorites as $article)
                        <dl class="well my-moment">
                            <dt><a href="{{ route('article', $article->id) }}" target="_blank">{{ $article->title }}</a></dt>
                            <dd class="occurred">
                                <small class="text-muted">
                                    <ul class="list-inline">
                                        <li>创建于：{{ $article->pivot->created_at->format('Y-m-d H:i') }}</li>
                                        <li>阅读：{{ $article->views }}</li>
                                        <li>评论：{{ $article->comments->count() }}</li>
                                        <li>喜欢：{{ $article->favorites()->likes()->count() }}</li>
                                    </ul>
                                </small>
                            </dd>
                            <dd>{{ $article->description }}</dd>
                        </dl>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有收藏过任何内容，不如先去本站的其他栏目逛逛，可能有您喜欢的内容哦</p>
                        </div>
@endforelse
                    </div>
                </div>
                <nav class="clearfix text-center" aria-label="Page navigation">
                    {!! $favorites->render() !!}
                </nav>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">猜您喜欢</h5>
                    </div>
                    <div class="list-group">
@foreach ($recommend as $article)
                        <a class="list-group-item" href="{{ route('article', $article->id) }}">{{ $article->title }}</a>
@endforeach
                    </div>
                </div>
@stop