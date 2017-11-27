@extends('shared.singleton')

@section('content')
            <div class="col-xs-12 col-sm-12">
                <div class="well">
                    <h1>热门栏目</h1>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation"><a href="#"><i class="glyphicon glyphicon-certificate" aria-hidden="true"></i>推荐<span class="hidden-xs">栏目</span></a></li>
                    <li role="presentation" class="active"><a href="#"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门<span class="hidden-xs">栏目</span></a></li>
                    <li role="presentation"><a href="#"><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>地区</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="row">
@forelse ($columns as $column)
                    <div class="col-xs-6 col-lg-4">
                        <div class="thumbnail text-center column-thumbnail">
                            <a href="{{ route('column.show', $column->id) }}" class="a icon">
@if ($column->thumbnails->isEmpty() !== true)
                                <img class="media-object img-rounded avatar-sm" src="{{ $column->thumbnails->first()->url }}" alt="{{ $column->name }}" />
@endif
                            </a>
                            <a href="{{ route('column.show', $column->id) }}" class="a">
                                <h2 class="heading">{{ $column->name }}</h2>
                                <p class="brief hidden-xs">{{ str_limit($column->description, 32) }}</p>
                            </a>
                            <div class="follow">
                                <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form" id="columnFollowForm-{{ $column->id }}">
                                    {{ csrf_field() }}
@if ($column->isFollowedBy(Auth::user()))
                                    {{ method_field('DELETE') }}
@endif
                                    <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-sm" {!! !Auth::check() ? 'data-toggle="modal" data-target="#loginModal"' : null !!} data-trigger="#columnFollowForm-{{ $column->id }}">
                                        <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}"></i>关注
                                    </button>
                                </form>
                            </div>
                            <hr />
                            <p class="count"><a href="{{ route('column.show', $column->id) }}" class="a">{{ $column->articles()->released()->count() }}篇文章</a><i class="divider">&middot;</i>{{ $column->follows()->count() }}人关注</p>
                        </div>
                    </div>
@empty
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p><strong>提示：</strong>还没有出现任何热门的栏目，<a href="#">去创建一个吧</a></p>
                    </div>
@endforelse
                </div>
@unless (Auth::check())
                @include('features.modal-login')
@endunless
            </div>
@stop

@section('scripts')
@unless (Auth::check())
    <script type="text/javascript" src="{{ asset('/assets/js/ajax-login.js') }}"></script>
@endunless
@stop