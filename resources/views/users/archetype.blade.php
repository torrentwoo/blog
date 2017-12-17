@extends('shared.prototype')

@section('content')
                <div class="row">
                    <div class="col-xs-12">
                        <div class="media" id="user-meta">
                            <div class="media-left" id="user-avatar">
                                <a href="{{ route('user.show', $user->id) }}">
                                    <img class="media-object img-circle avatar-lg" src="{{ $user->gravatar(96) }}" alt="{{ $user->name }}" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h1 class="heading-username">{{ $user->name }}</h1>
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
@can ('message', $user)
                                <a href="{{ route('message.show', $user->id) }}" class="btn btn-info btn-xs" role="button">
                                    <i class="glyphicon glyphicon-send" aria-hidden="true"></i>站内信
                                </a>
@endcan
@can ('follow', $user)
                                <form method="POST" action="{{ route('follow.user', $user->id) }}" id="userFollowForm" class="follow-form">
                                    {{ csrf_field() }}
@if ($user->isFollowedBy(Auth::user()))
                                    {{ method_field('DELETE') }}
@endif
                                    <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-xs" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#userFollowForm">
                                        <i class="glyphicon {{ $user->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                    </button>
                                </form>
@endcan
                            </div>
@endif
                        </div>
                    </div>
@yield('subContent')
                </div>
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
@if (empty($user->socials) !== true)
                    <dd>
                        <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                        <span class="sr-only">个人链接：</span>
                        <span class="media-labels">
@if (empty($user->socials->weibo) !== true)
                            <a class="label label-danger" target="_blank" href="{{ $user->socials->weibo }}">微博</a>
@endif
@if (empty($user->socials->weixin) !== true)
                            <a class="label label-success" href="javascript:void(0);" data-toggle="modal" data-target="#weixinModal">微信</a>
                            <!-- weixin display modal -->
                            <div class="modal fade" id="weixinModal" tabindex="-1" role="dialog" aria-labelledby="weixinModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="weixinModalLabel">{{ $user->name }} 的微信二维码</h4>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ route('file.show', $user->socials->weixin) }}" class="img-rounded avatar-xl" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endif
@if (empty($user->socials->qq) !== true)
                            <a class="label label-info" target="_blank" href="http://{{ $user->socials->qq }}.qzone.qq.com">QQ</a>
@endif
                        </span>
                    </dd>
@endif
                </dl>

                <hr />
                <dl class="user-sidebar" id="user-introduction">
                    <dt class="text-muted">个人简介</dt>
                    <dd>{{ $user->introduction or '还没有填写“个人简介”...' }}</dd>
                </dl>
                <hr />
                <dl class="user-sidebar" id="user-subscriptions">
                    <dd><a href="{{ route('subscription.index') }}"><i class="glyphicon glyphicon-headphones" aria-hidden="true"></i>我关注的栏目</a></dd>
                    <dd><a href="{{ route('user.favorites', $user->id) }}"><i class="glyphicon glyphicon-heart" aria-hidden="true"></i>我喜欢的文章</a></dd>
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
    <script type="text/javascript" src="{{ asset('/assets/js/app-login.js') }}"></script>
@endunless
@yield('subScripts')
@stop