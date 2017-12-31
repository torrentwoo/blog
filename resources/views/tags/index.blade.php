@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">标签</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <ul class="list-inline" id="tags-label">
@foreach ($tags as $tag)
                                <li><a href="{{ route('tags.show', $tag->id) }}" class="label label-{{ collect(['default', 'primary', 'success', 'info', 'warning', 'danger'])->random() }}">{{ $tag->name }}</a></li>

@endforeach
                        </ul>
                    </div>
                </div>
@stop