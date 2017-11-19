@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">用户</a></li>
                    <li class="active">我的文章</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
@forelse ($articles as $article)
                        <dl class="well my-moment">
@if ($article->approval)
                            <dt><a href="{{ route('article.show', $article->id) }}" target="_blank">{{ $article->title }}</a></dt>
@else
                            <dt><a class="text-muted" href="#" title="这篇文章暂未通过审核，点击链接查看具体原因">{{ $article->title }}</a></dt>
@endif
                            <dd class="occurred">
                                <small class="text-muted">
                                    <ul class="list-inline">
                                        <li>创建于：{{ $article->created_at->format('Y-m-d H:i') }}</li>
                                        <li>阅读：{{ $article->views }}</li>
                                        <li>评论：{{ $article->comments->count() }}</li>
                                        <li>喜欢：{{ $article->likes->count() }}</li>
                                    </ul>
                                </small>
                            </dd>
                            <dd>{{ $article->description }}</dd>
                        </dl>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>您还没有发表过任何文章哦</p>
                        </div>
@endforelse
                    </div>
                </div>
                <nav class="text-center" aria-label="Page navigation">
                    {!! $articles->render() !!}
                </nav>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">我的综合评价最高的文章</h5>
                    </div>
                    <div class="list-group">
@foreach ($popular as $article)
                        <a class="list-group-item" href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a>
@endforeach
                    </div>
                </div>
@stop