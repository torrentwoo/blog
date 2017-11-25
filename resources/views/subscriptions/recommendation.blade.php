@extends('subscriptions.archetype')

@section('rightContent')
            <div class="col-xs-12 col-sm-8">
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation" class="active">
                        <a href="#authors" id="authors-tab" data-toggle="tab" aria-controls="authors" aria-expanded="true" role="tab">
                            <i class="glyphicon glyphicon-user" aria-hidden="true"></i><span class="hidden-xs">推荐</span>作者
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#columns" id="columns-tab" data-toggle="tab" aria-controls="columns" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-th-large" aria-hidden="true"></i><span class="hidden-xs">推荐</span>栏目
                        </a>
                    </li>
{{--
                    <li role="presentation">
                        <a href="#dynamic" id="dynamic-tab" data-toggle="tab" aria-controls="dynamic" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-refresh" aria-hidden="true"></i>发现
                        </a><!-- random, based on following user -->
                    </li>
--}}
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="authors" aria-labelledby="authors-tab">
@forelse ($authors as $author)
                        <div class="media header-media">
                            <div class="media-left">
                                <a href="{{ route('user.show', $author->id) }}">
                                    <img class="media-object" data-src="holder.js/64x64" alt="{{ $author->name }}" src="{{ $author->gravatar(64) }}" data-holder-rendered="true" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h1 class="media-heading h4">{{ $author->name }}</h1>
@if (empty($author->introduction) !== true)
                                <div class="text-muted">{{ $author->introduction }}</div>
@endif
                                <small class="text-muted">发表文章{{ $author->articles()->released()->count() }}篇<i class="divider">&middot;</i>被{{ $author->follows->count() }}人关注</small>
                            </div>
                            <div class="media-right nowrap-landscape" id="user-buttons">
                                <form method="POST" action="{{ route('follow.user', $author->id) }}" class="follow-form">
                                    {{ csrf_field() }}
@if ($author->isFollowedBy(Auth::user()))
                                    {{ method_field('DELETE') }}
@endif
                                    <button type="submit" class="btn btn-success btn-xs">
                                        <i class="glyphicon {{ $author->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                    </button>
                                </form>
                            </div>
                        </div>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>很抱歉，现在还没有可供关注的推荐作者出现</p>
                        </div>
@endforelse
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="columns" aria-labelledby="columns-tab">
@forelse ($columns as $column)
                        <div class="media header-media">
@if (!$column->thumbnails->isEmpty())
                                <div class="media-left">
                                    <a href="{{ route('column.show', $column->id) }}">
                                        <img class="media-object" data-src="holder.js/64x64" alt="{{ $column->name }}" src="{{ $column->thumbnails->first()->url }}" data-holder-rendered="true" />
                                    </a>
                                </div>
@endif
                            <div class="media-body">
                                <h1 class="media-heading h4">{{ $column->name }}</h1>
                                <div class="text-muted">{{ $column->description }}</div>
                                <small class="text-muted">收录文章{{ $column->articles()->released()->count() }}篇<i class="divider">&middot;</i>被{{ $column->follows->count() }}人关注</small>
                            </div>
                            <div class="media-right nowrap-landscape" id="user-buttons">
                                <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form">
                                    {{ csrf_field() }}
@if ($column->isFollowedBy(Auth::user()))
                                    {{ method_field('DELETE') }}
@endif
                                    <button type="submit" class="btn btn-success btn-xs">
                                        <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                    </button>
                                </form>
                            </div>
                        </div>
@empty
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p><strong>提示：</strong>很抱歉，现在还没有可供订阅的推荐栏目出现</p>
                        </div>
@endforelse
                    </div>
{{--
                    <div role="tabpanel" class="tab-pane fade" id="dynamic" aria-labelledby="dynamic-tab">
                        dynamic
                    </div>
--}}
                </div>
            </div>
@stop