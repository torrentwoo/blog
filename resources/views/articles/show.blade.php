@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column.index') }}">热门栏目</a></li>
                    <li><a href="{{ route('column.show', $article->column->id) }}">{{ $article->column->name }}</a></li>
                    <li class="active">{{ $article->title }}</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="page-header">
                            <h1>{{ $article->title }}</h1>
                            <ul id="article-brief" class="list-inline">
                                <li>发表在：{{ $article->released_at->diffForHumans() }}</li>
                                <li>作者：<a href="{{ route('user.show', $article->author->id) }}">{{ $article->author->name }}</a>
@if (!Auth::check() || (Auth::check() && Auth::user()->id !== $article->author->id))
                                    <small class="offset-right">
                                        <form method="POST" action="{{ route('follow.user', $article->author->id) }}" id="authorFollowForm" class="follow-form">
                                            {{ csrf_field() }}
@if ($article->author->isFollowedBy(Auth::user()))
                                            {{ method_field('DELETE') }}
@endif
                                            <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-xs" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#authorFollowForm">
                                                <i class="glyphicon {{ $article->author->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                            </button>
                                        </form>
                                    </small>
@endif
                                </li>
                                <li>浏览：{{ $article->views }} 次</li>
                                <li>评论：{{ $article->comments->count() }}</li>
                                <li>喜欢：{{ $article->likes->count() }}</li>
                                <li>赞赏：</li>
                            </ul>
                        </div>
                        <div class="page-content">
                            {!! $article->content !!}
                        </div>
@if (isset($article->tags) && !$article->tags->isEmpty())
                        <div id="tags">
@foreach ($article->tags as $tag)
                            <a href="{{ route('tag.show', $tag->id) }}" class="label label-default">{{ $tag->name }}</a>
@endforeach
                        </div>
@endif
                        <div id="preferences" class="row">
                            <div id="article-author" class="col-xs-12 col-md-10 col-md-offset-1">
                                <div class="well media">
                                    <div class="media-left">
                                        <a href="{{ route('user.show', $article->author->id) }}">
                                            <img alt="{{ $article->author->name }}" data-src="holder.js/64x64" class="media-object img-circle avatar-sm" src="{{ $article->author->gravatar(64) }}" data-holder-rendered="true" />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><a href="{{ route('user.show', $article->author->id) }}">{{ $article->author->name }}</a></h2>
                                        <p class="text-muted">发表文章 {{ $article->author->articles()->released()->count() }} 篇，被 {{ $article->author->followingUsers->count() }} 人关注，收获 {{ $article->author->likedUsers()->count() }} 个喜欢</p>
                                    </div>
@if (!Auth::check() || (Auth::check() && Auth::user()->id !== $article->author->id))
                                    <div class="media-right" id="user-buttons">
                                        <form method="POST" action="{{ route('follow.user', $article->author->id) }}" id="authorBriefFollowForm" class="follow-form">
                                            {{ csrf_field() }}
@if ($article->author->isFollowedBy(Auth::user()))
                                            {{ method_field('DELETE') }}
@endif
                                            <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-xs" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#authorBriefFollowForm">
                                                <i class="glyphicon {{ $article->author->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                                            </button>
                                        </form>
                                    </div>
@endif
@if ($article->author->introduction)
                                    <div class="media-bottom text-muted">
                                        {{ $article->author->introduction }}
                                    </div>
@endif
                                </div>
                            </div>
                            <div id="article-rewards" class="col-xs-12 col-md-12 text-center">
                                <p><a href="javascript:void(0);" class="btn btn-primary btn-sm" role="button">赞赏支持</a></p>
                                <ul class="list-inline">
                                    <li>User 1</li>
                                    <li>User 2</li>
                                    <li>User 3</li>
                                </ul>
                                <hr />
                            </div>
                            <div id="article-express" class="col-xs-6 col-md-6">
@if (!Auth::check() || (Auth::check() && Auth::user()->id !== $article->author->id))
                                <div class="btn-toolbar" role="toolbar">
                                    <form method="POST" action="{{ route('like.article', $article->id) }}" id="articleLikeForm" class="btn-group" role="group">
                                        {{ csrf_field() }}
@if ($article->isLikedBy(Auth::user()))
                                        {{ method_field('DELETE') }}
@endif
                                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-danger btn-sm btn-first" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#articleLikeForm">
                                            <i class="glyphicon {{ $article->isLikedBy(Auth::user()) ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}" aria-hidden="true"></i>喜欢
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('favorite.article', $article->id) }}" id="articleFavoriteForm" class="btn-group" role="group">
                                        {{ csrf_field() }}
@if ($article->isFavoriteBy(Auth::user()))
                                        {{ method_field('DELETE') }}
@endif
                                        <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-warning btn-sm btn-last" {!! Auth::check() ? null : 'data-toggle="modal" data-target="#loginModal"' !!} data-trigger="#articleFavoriteForm">
                                            <i class="glyphicon {{ $article->isFavoriteBy(Auth::user()) ? 'glyphicon-star' : 'glyphicon-star-empty' }}" aria-hidden="true"></i>收藏
                                        </button>
                                    </form>
                                </div>
@endif
                            </div>
                            <ul id="article-share" class="col-xs-6 col-md-6 list-inline text-right">
                                <li><a href="#">微博</a></li>
                                <li><a href="#">微信</a></li>
                                <li class="dropup">
                                    <a href="javascript:void(0);" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        更多分享
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">分享到 QQ 空间</a></li>
                                        <li><a href="#">分享到豆瓣</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pager">
                                <li class="previous">
@if (isset($prev))
                                    <a href="{{ route('article.show', $prev->id) }}" title="{{ $prev->title }}"><i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>上一篇</a>
@else
                                    <button class="btn btn-default pull-left disabled"><i class="glyphicon glyphicon-menu-left" aria-hidden="true"></i>上一篇</button>
@endif
                                </li>
                                <li class="next">
@if (isset($next))
                                    <a href="{{ route('article.show', $next->id) }}" title="{{ $next->title }}">下一篇<span class="glyphicon glyphicon-menu-right offset-right" aria-hidden="true"></span></a>
@else
                                    <button class="btn btn-default pull-right disabled">下一篇<span class="glyphicon glyphicon-menu-right offset-right" aria-hidden="true"></span></button>
@endif
                                </li>
                            </ul>
                        </nav>
                    </div>
@if (isset($article->comments) && !$article->comments->isEmpty())
                    <div id="comments" class="col-xs-12">
                        <ul class="media-list">
@foreach ($article->comments as $comment)
                            <li class="media">
                                <div class="media-left">
                                    <img alt="{{ $comment->commentator->name }}" class="media-object img-circle avatar-sm" src="{{ $comment->commentator->gravatar(64) }}" data-holder-rendered="true">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comment->commentator->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </li>
@endforeach
                        </ul>
                        <p class="text-right">
                            <a class="btn btn-info" href="{{ route('article.comments', $article->id) }}" role="button">查看更多评论</a>
                        </p>
                    </div>
@endif
                    <div class="col-xs-12">
                        @include('features.comment-form', ['modalLogin' => isset($modalLogin) ? $modalLogin : false])
                    </div>
@unless (Auth::check())
                    @include('features.modal-login')
@endunless
                </div>
@stop

@section('sidebar')
                @parent
@stop

@section('scripts')
@unless (Auth::check())
    <script type="text/javascript" src="{{ asset('/assets/js/ajax-login.js') }}"></script>
@endunless
@stop