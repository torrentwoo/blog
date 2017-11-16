@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">{{ $column->name }}</li>
                </ol>
                <div class="row">
@foreach ($articles as $article)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a href="{{ route('article', $article->id) }}" title="{{ $article->title }}">
                                <img class="img-responsive" src="{{ $article->snapshot->thumbnail_url or $article->attachment->url }}" alt="{{ $article->title }}" />
                            </a>
                            <div class="caption">
                                <h2>{{ $article->title }}</h2>
                                <p>{{ $article->description }}</p>
                                <p class="text-right"><a class="btn btn-default" href="{{ route('article', $article->id) }}" role="button">View details &raquo;</a></p>
                            </div>
                        </div>
                    </div>
@endforeach
                </div>
                <nav class="text-center" aria-label="Page navigation">
                    {!! $articles->render() !!}
                </nav>
@stop