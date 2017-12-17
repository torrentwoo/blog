@extends('shared.singleton')

@section('content')
            <div class="col-xs-12 col-sm-12">
                <div class="well">
                    <h1>热门栏目</h1>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation">
                        <a href="#recommend" id="recommend-tab" data-toggle="tab" aria-controls="recommend" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-certificate" aria-hidden="true"></i>推荐<span class="hidden-xs">栏目</span>
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="true" role="tab">
                            <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门<span class="hidden-xs">栏目</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#region" id="region-tab" data-toggle="tab" aria-controls="region" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>地区
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="row tab-pane fade" id="recommend" aria-labelledby="recommend-tab">
@forelse ($recommend as $column)
                        <div class="col-xs-6 col-lg-4">
                            <div class="thumbnail text-center column-thumbnail">
                                <a href="{{ route('column.show', $column->id) }}" class="a icon">
@if ($column->thumbnails->isEmpty() !== true)
                                    <img class="media-object img-rounded avatar-md" src="{{ $column->thumbnails->first()->url }}" alt="{{ $column->name }}" />
@endif
                                </a>
                                <a href="{{ route('column.show', $column->id) }}" class="a">
                                    <h2 class="heading">{{ $column->name }}</h2>
                                    <p class="brief hidden-xs">{{ str_limit($column->description, 32) }}</p>
                                </a>
                                <div class="follow">
                                    <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form" id="recommendFollowForm-{{ $column->id }}">
                                        {{ csrf_field() }}
@if ($column->isFollowedBy(Auth::user()))
                                        {{ method_field('DELETE') }}
@endif
                                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-sm" {!! !Auth::check() ? 'data-toggle="modal" data-target="#loginModal"' : null !!} data-trigger="#recommendFollowForm-{{ $column->id }}">
                                            <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}"></i>关注
                                        </button>
                                    </form>
                                </div>
                                <hr />
                                <p class="count"><a href="{{ route('column.show', $column->id) }}" class="a">{{ $column->articles()->released()->count() }}篇文章</a><i class="divider">&middot;</i>{{ $column->follows()->count() }}人关注</p>
                            </div>
                        </div>
@empty
                        <div class="col-xs-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p><strong>提示：</strong>还没有可推荐的栏目哦</p>
                            </div>
                        </div>
@endforelse
                    </div>
                    <div role="tabpanel" class="row tab-pane fade active in" id="popular" aria-labelledby="popular-tab">
@forelse ($popular as $column)
                        <div class="col-xs-6 col-lg-4">
                            <div class="thumbnail text-center column-thumbnail">
                                <a href="{{ route('column.show', $column->id) }}" class="a icon">
@if ($column->thumbnails->isEmpty() !== true)
                                    <img class="media-object img-rounded avatar-md" src="{{ $column->thumbnails->first()->url }}" alt="{{ $column->name }}" />
@endif
                                </a>
                                <a href="{{ route('column.show', $column->id) }}" class="a">
                                    <h2 class="heading">{{ $column->name }}</h2>
                                    <p class="brief hidden-xs">{{ str_limit($column->description, 32) }}</p>
                                </a>
                                <div class="follow">
                                    <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form" id="popularFollowForm-{{ $column->id }}">
                                        {{ csrf_field() }}
@if ($column->isFollowedBy(Auth::user()))
                                        {{ method_field('DELETE') }}
@endif
                                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-sm" {!! !Auth::check() ? 'data-toggle="modal" data-target="#loginModal"' : null !!} data-trigger="#popularFollowForm-{{ $column->id }}">
                                            <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}"></i>关注
                                        </button>
                                    </form>
                                </div>
                                <hr />
                                <p class="count"><a href="{{ route('column.show', $column->id) }}" class="a">{{ $column->articles()->released()->count() }}篇文章</a><i class="divider">&middot;</i>{{ $column->follows()->count() }}人关注</p>
                            </div>
                        </div>
@empty
                        <div class="col-xs-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p><strong>提示：</strong>还没有出现任何热门的栏目，<em>去看看有什么推荐栏目吧</em></p>
                            </div>
                        </div>
@endforelse
                    </div>
                    <div role="tabpanel" class="row tab-pane fade" id="region" aria-labelledby="region-tab">
@forelse ($region as $column)
                        <div class="col-xs-6 col-lg-4">
                            <div class="thumbnail text-center column-thumbnail">
                                <a href="{{ route('column.show', $column->id) }}" class="a icon">
                                    @if ($column->thumbnails->isEmpty() !== true)
                                        <img class="media-object img-rounded avatar-md" src="{{ $column->thumbnails->first()->url }}" alt="{{ $column->name }}" />
                                    @endif
                                </a>
                                <a href="{{ route('column.show', $column->id) }}" class="a">
                                    <h2 class="heading">{{ $column->name }}</h2>
                                    <p class="brief hidden-xs">{{ str_limit($column->description, 32) }}</p>
                                </a>
                                <div class="follow">
                                    <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form" id="regionFollowForm-{{ $column->id }}">
                                        {{ csrf_field() }}
                                        @if ($column->isFollowedBy(Auth::user()))
                                            {{ method_field('DELETE') }}
                                        @endif
                                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-sm" {!! !Auth::check() ? 'data-toggle="modal" data-target="#loginModal"' : null !!} data-trigger="#regionFollowForm-{{ $column->id }}">
                                            <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}"></i>关注
                                        </button>
                                    </form>
                                </div>
                                <hr />
                                <p class="count"><a href="{{ route('column.show', $column->id) }}" class="a">{{ $column->articles()->released()->count() }}篇文章</a><i class="divider">&middot;</i>{{ $column->follows()->count() }}人关注</p>
                            </div>
                        </div>
@empty
                        <div class="col-xs-12">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p><strong>提示：</strong>还没有任何地区专属栏目，<em>去看看有什么推荐栏目吧</em></p>
                            </div>
                        </div>
@endforelse
                    </div>
                </div>
@unless (Auth::check())
                @include('features.modal-login')
@endunless
            </div>
@stop

@section('scripts')
@unless (Auth::check())
    <script type="text/javascript" src="{{ asset('/assets/js/app-login.js') }}"></script>
@endunless
@stop