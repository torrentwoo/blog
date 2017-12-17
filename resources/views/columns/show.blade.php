@extends('shared.prototype')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column.index') }}">热门栏目</a></li>
                    <li class="active">{{ $column->name }}</li>
                </ol>
                <div class="media header-media">
@if (!$column->thumbnails->isEmpty())
                    <div class="media-left">
                        <a href="{{ route('column.show', $column->id) }}">
                            <img class="media-object img-rounded avatar-md" alt="{{ $column->name }}" src="{{ $column->thumbnails->first()->url }}" />
                        </a>
                    </div>
@endif
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $column->name }}</h1>
                        <p>收录文章{{ $column->articles()->released()->count() }}篇<i class="divider">&middot;</i>被{{ $column->follows->count() }}人关注</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">投稿</button>
                        <form method="POST" action="{{ route('follow.column', $column->id) }}" class="follow-form" id="columnFollowForm">
                            {{ csrf_field() }}
@if ($column->isFollowedBy(Auth::user()))
                            {{ method_field('DELETE') }}
@endif
                            <button type="{{ Auth::check() ? 'submit' : 'button' }}" class="btn btn-success btn-xs" {!! !Auth::check() ? 'data-toggle="modal" data-target="#loginModal"' : null !!} data-trigger="#columnFollowForm">
                                <i class="glyphicon {{ $column->isFollowedBy(Auth::user()) ? 'glyphicon-minus' : 'glyphicon-plus' }}" aria-hidden="true"></i>关注
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation">
                                <a href="#commented" id="commented-tab" data-toggle="tab" aria-controls="commented" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-comment" aria-hidden="true"></i>热评<span class="hidden-xs">文章</span>
                                </a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="#latest" id="latest-tab" data-toggle="tab" aria-controls="latest" aria-expanded="true" role="tab">
                                    <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-fire" aria-hidden="true"></i><span class="hidden-xs">栏目</span>热门
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="commented" aria-labelledby="commented-tab">
@forelse ($commented as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h2 class="h4 media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h2>
                                        <ul class="list-inline text-muted media-author">
                                            <li><a href="{{ route('user.show', $article->author->id) }}" class="text-muted">
                                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                    <span class="sr-only">作者：</span>
                                                    {{ $article->author->name }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">发布日期：</span>
                                                {{ $article->released_at->diffForHumans() }}
                                            </li>
                                        </ul>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                    <span class="sr-only">评论：</span>
                                                    {{ $article->comments->count() }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                <span class="sr-only">喜欢：</span>
                                                {{ $article->likes->count() }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
@empty
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><strong>提示：</strong>还没有发现被评论的文章哦</p>
                                </div>
@endforelse
                            </div>
                            <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
@forelse ($latest as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h2 class="h4 media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h2>
                                        <ul class="list-inline text-muted media-author">
                                            <li><a href="{{ route('user.show', $article->author->id) }}" class="text-muted">
                                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                    <span class="sr-only">作者：</span>
                                                    {{ $article->author->name }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">发布日期：</span>
                                                {{ $article->released_at->diffForHumans() }}
                                            </li>
                                        </ul>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                    <span class="sr-only">评论：</span>
                                                    {{ $article->comments->count() }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                <span class="sr-only">喜欢：</span>
                                                {{ $article->likes->count() }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
@empty
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><strong>提示：</strong>本栏目暂时没有收录任何文章哦</p>
                                </div>
@endforelse
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="popular" aria-labelledby="popular-tab">
@forelse ($popular as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h2 class="h4 media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h2>
                                        <ul class="list-inline text-muted media-author">
                                            <li><a href="{{ route('user.show', $article->author->id) }}" class="text-muted">
                                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                                    <span class="sr-only">作者：</span>
                                                    {{ $article->author->name }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">发布日期：</span>
                                                {{ $article->released_at->diffForHumans() }}
                                            </li>
                                        </ul>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li><a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                    <span class="sr-only">评论：</span>
                                                    {{ $article->comments->count() }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                <span class="sr-only">喜欢：</span>
                                                {{ $article->likes->count() }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
@empty
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><strong>提示：</strong>本栏目暂时没有出现热门内容哦</p>
                                </div>
@endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="text-center" aria-label="Page navigation">
                    {!! $latest->render() !!}
                </nav>
@stop

@unless (Auth::check())
                @include('features.modal-login')
@endunless

@section('sidebar')
                <h5 class="text-muted">栏目简介</h5>
                <p>{{ $column->description }}</p>
                <p class="h5">投稿须知</p>

                <hr />

                <p>高产作者</p>
@stop

@section('scripts')
@unless (Auth::check())
    <script type="text/javascript" src="{{ asset('/assets/js/app-login.js') }}"></script>
@endunless
@stop