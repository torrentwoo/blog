@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
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
                    <div class="media-right">
                        <a href="#">
                            <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWZjOWRmOTZiZSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZmM5ZGY5NmJlIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNS42Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                        </a>
                        <a href="#">
                            加关注
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <ul class="nav nav-tabs" id="column-tabs">
                            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>新近评论</a></li>
                            <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>最新发表</a></li>
                            <li role="presentation"><a href="#"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span>栏目热门</a></li>
                        </ul>
@foreach ($articles as $article)
                        <div class="media media-article">
                            <div class="media-left">
                                <a href="{{ route('article', $article->id) }}">
                                    <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->snapshot->thumbnail_url or $article->attachment->url }}" data-holder-rendered="true" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h2 class="h4 media-heading media-title">
                                    <a href="{{ route('article', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
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
                                        <a class="text-muted" href="{{ route('article', $article->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $article->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('article', $article->id) . '#comments' }}">
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