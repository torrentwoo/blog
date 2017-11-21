@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column.index') }}">热门栏目</a></li>
                    <li class="active">{{ $column->name }}</li>
                </ol>
                <div class="media" id="column-header">
@if (!$column->thumbnails->isEmpty())
                    <div class="media-left">
                        <a href="{{ route('column.show', $column->id) }}">
                            <img class="media-object" data-src="holder.js/64x64" alt="{{ $column->name }}" src="{{ $column->thumbnails->first()->url }}" data-holder-rendered="true" />
                        </a>
                    </div>
@endif
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $column->name }}</h1>
                        <p>收录文章{{ $column->articles()->released()->count() }}篇<i class="divider">&middot;</i>被{{ $column->follows->count() }}人关注</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">投稿</button>
                        <button type="button" class="btn btn-success btn-xs">
                            <i class="glyphicon glyphicon-minus glyphicon-plus" aria-hidden="true"></i>关注
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation"><a href="#"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i>热评<span class="hidden-xs">文章</span></a></li>
                            <li role="presentation" class="active"><a href="#"><i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span></a></li>
                            <li role="presentation"><a href="#"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i><span class="hidden-xs">栏目</span>热门</a></li>
                        </ul>
@foreach ($articles as $article)
                        <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" data-holder-rendered="true" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h2 class="h4 media-heading media-title">
                                    <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h2>
                                <ul class="list-inline text-muted media-author">
                                    <li><a href="{{ route('user.show', $article->author->id) }}" class="text-muted">
                                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            <span class="sr-only">作者：</span>
                                            {{ $article->author->name }}
                                        </a>
                                    </li>
                                    <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="sr-only">文章发布在：</span>
                                        {{ $article->released_at->diffForHumans() }}
                                    </li>
                                </ul>
                                <p>{{ $article->description }}</p>
                                <ul class="list-inline media-meta">
                                    <li>
                                        <a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $article->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
                                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                            <span class="sr-only">评论：</span>
                                            {{ $article->comments->count() }}
                                        </a>
                                    </li>
                                    <li>
                                    <span class="text-muted">
                                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                        <span class="sr-only">喜欢：</span>
                                        {{ $article->likes->count() }}
                                    </span>
                                    </li>
                                </ul>
                            </div>
                            <hr />
                        </div>
@endforeach
                    </div>
                </div>
                <nav class="text-center" aria-label="Page navigation">
                    {!! $articles->render() !!}
                </nav>
@stop

@section('sidebar')
                <h5 class="text-muted">栏目简介</h5>
                <p>aa</p>
                <p class="h5">投稿须知</p>

                <hr />

                <p>高产作者</p>
@stop