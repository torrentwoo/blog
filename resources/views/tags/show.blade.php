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
                        <div class="media">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img class="media-object" src="{{ $article->thumbnails->first()->url }}" style="width:64px;height:64px;" data-src="holder.js/64x64" alt="{{ $article->title }}" data-holder-rendered="true" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></h4>
                                <p>{{ $article->description }}</p>
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
                    {!! $articles->render() !!}
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