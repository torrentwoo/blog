@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">标签</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
@foreach ($tags as $tag)
                        <a href="{{ route('tag.show', $tag->id) }}">{{ $tag->name }}</a>
@endforeach
                    </div>
                </div>
@stop