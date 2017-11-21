@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12">
                        <div class="media" id="user-meta">
                            <div class="media-left" id="user-avatar">
                                <a href="{{ route('user.show', $user->id) }}">
                                    <img class="img-rounded" src="{{ $user->gravatar(80) }}" alt="{{ $user->name }}" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h1 id="user-name">{{ $user->name }}</h1>
                                <div class="row" id="user-counts">
                                    <div class="col-xs-6 col-sm-3">
                                        <span class="count block-landscape">{{ $user->followedUsers->count() }}</span>
                                        <span class="text-muted">关注</span>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <span class="count block-landscape">{{ $user->followingUsers->count() }}</span>
                                        <span class="text-muted">粉丝</span>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <span class="count block-landscape">{{ $user->articles->count() }}</span>
                                        <span class="text-muted">文章</span>
                                    </div>
                                    <div class="col-xs-6 col-sm-3">
                                        <span class="count block-landscape">{{ $user->likedUsers()->count() }}</span>
                                        <span class="text-muted">喜欢</span>
                                    </div>
                                </div>
                            </div>
@if (!Auth::check() || (Auth::check() && Auth::user()->id !== $user->id))
                            <div class="media-right nowrap-landscape" id="user-buttons">
                                <button type="button" class="btn btn-info btn-xs">发消息</button>
                                <form method="POST" action="{{ $user->isFollowedBy(Auth::user()) ? route('follow.remove', $user->id) : route('follow.add', $user->id) }}" id="userFollowForm" class="follow-form">
                                    {{ csrf_field() }}
@if ($user->isFollowedBy(Auth::user()))
                                    {{ method_field('DELETE') }}
@endif
                                    <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-xs" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#userFollowForm">
                                        <i class="glyphicon {{ $user->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                    </button>
                                </form>
                            </div>
@endif
                        </div>
                    </div>
@yield('subContent')
                </div><!-- /div.row -->
@unless (Auth::check())
                @include('features.modal-login')
@endunless
@stop

@section('sidebar')
@section('subSidebar')
                <dl class="user-sidebar" id="user-brief">
                    <dd>
                        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                        <span class="sr-only">所在城市：</span>
                        <span>{{ $user->location or 'Planet Earth, Anyway' }}</span>
                    </dd>
                    <dd>
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <span class="sr-only">注册日期：</span>
                        <span>{{ $user->created_at->format('Y-m-d') }} 入驻</span>
                    </dd>
                    <dd>
                        <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                        <span class="sr-only">个人链接：</span>
                        <span>
                            <a class="label label-danger" href="#">微博</a>
                            <a class="label label-success" href="javascript:void(0);">微信</a>
                            <a class="label label-info" href="#">QQ</a>
                        </span>
                    </dd>
                </dl>
                <hr />
                <dl class="user-sidebar" id="user-introduction">
                    <dt class="text-muted">个人简介</dt>
                    <dd>{{ $user->introduction or '还没有填写“个人简介”...' }}</dd>
                </dl>
                <hr />
                <dl class="user-sidebar" id="user-subscriptions">
                    <dd><a href="#subscriptions"><i class="glyphicon glyphicon-headphones" aria-hidden="true"></i>我关注的栏目</a></dd>
                    <dd><a href="#"><i class="glyphicon glyphicon-heart" aria-hidden="true"></i>我喜欢的文章</a></dd>
                </dl>
                <hr />
                <dl class="user-sidebar" id="user-extensions">
                    <dt class="text-muted">专题栏目</dt>
                    <dd><a href="#void" class="text-primary"><i class="glyphicon glyphicon-book" aria-hidden="true"></i>测试专题栏目</a></dd>
                    <dd><a href="#new" class="text-success"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>创建一个新专题</a></dd>
                </dl>
@show
@stop

@section('scripts')
@unless (Auth::check())
    <script type="text/javascript" src="{{ asset('/assets/js/ajax-login.js') }}"></script>
@endunless
@section('subScripts')
@show
@stop