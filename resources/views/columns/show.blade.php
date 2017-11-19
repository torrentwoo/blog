@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column.index') }}">热门栏目</a></li>
                    <li class="active">{{ $column->name }}</li>
                </ol>
                <div class="media" id="column-header">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWZjOWRmYjc3NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZmM5ZGZiNzc0Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNS42Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                        </a>
                    </div>
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $column->name }}</h1>
                        <p>收录文章：{{ $column->articles()->released()->count() }} 篇</p>
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
@if (!$article->thumbnail->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->thumbnail->first()->url }}" data-holder-rendered="true" />
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
                                        {{ $article->favorites()->likes()->count() }}
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