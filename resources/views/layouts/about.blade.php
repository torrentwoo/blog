@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li class="active">关于</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-content">
                            <h1>关于</h1>
                            <p>Content goes here...</p>
                        </div>
                    </div>
                </div>
@stop

{{--
    Static pages, shared sidebar
--}}
@section('sidebar')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">快捷导航</h5>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item active" href="{{ route('about') }}">关于</a>
                        <a class="list-group-item" href="{{ route('contact') }}">联系</a>
                        <a class="list-group-item" href="{{ route('help') }}">帮助</a>
                    </div>
                </div>
@stop