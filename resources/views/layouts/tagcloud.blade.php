@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="/demo">Home</a></li>
                    <li class="active">Tag Cloud</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <a href="{{ route('tag', 1) }}">标签</a>
                        <a href="{{ route('tag', 2) }}">Testing</a>
                        <a href="{{ route('tag', 3) }}">Delta</a>
                        <a href="{{ route('tag', 4) }}">Alphabet</a>
                    </div>
                </div>
@stop