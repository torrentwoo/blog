@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('tag.index') }}">标签</a></li>
                    <li class="active">{{ $tag->name }}</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
@forelse ($articles as $article)
                        <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img class="media-object media-preview" src="{{ $article->thumbnails->first()->url }}" alt="{{ $article->title }}" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h4 class="media-heading media-title"><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></h4>
                                <ul class="list-inline text-muted media-author">
                                    <li><a href="{{ route('user.show', $article->author->id) }}" class="text-muted">
                                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            <span class="sr-only">作者：</span>
                                            {{ $article->author->name }}
                                        </a>
                                    </li>
                                    <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="sr-only">发布日期：</span>
                                        {{ $article->released_at->diffForHumans() }}
                                    </li>
                                </ul>
                                <p>{{ $article->description }}</p>
@if ($article->tags->isEmpty() !== true)
                                <ul class="list-inline media-labels">
@foreach ($article->tags as $tag)
                                    <li><a href="{{ route('tag.show', $tag->id) }}" class="label label-{{ collect(['default', 'primary', 'success', 'info', 'warning', 'danger'])->random() }}">{{ $tag->name }}</a></li>
@endforeach
                                </ul>
@endif
                                <ul class="list-inline media-meta">
                                    <li><a class="media-column" href="{{ route('column.show', $article->column->id) }}">{{ $article->column->name }}</a></li>
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
                        </div>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>还没有任何文章使用该标签</p>
                        </div>
@endforelse
                    </div>
                </div><!-- /row -->
                <nav class="text-center" aria-label="Page navigation">
                    {!! $pagination->render() !!}
                </nav>
@stop

@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">热门标签</h5>
                    </div>
                    <div class="list-group">
@forelse ($popular as $tag)
                        <a class="list-group-item {{ isset($id) && $id === $tag->id ? 'active' : null }}" href="{{ route('tag.show', $tag->id) }}">{{ $tag->name }}</a>
@empty
                        <p class="list-group-item">暂未出现热门标签</p>
@endforelse
                    </div>
                </div>
@stop