@extends('subscriptions.archetype')

@section('rightContent')
            <div class="col-xs-12 col-sm-8">
@if ($followings->isEmpty() !== true && $followings->first()->followable_type === App\Models\User::class)
                <div class="media header-media">
                    <div class="media-left">
                        <a href="{{ route('user.show', $origin->id) }}">
                            <img class="media-object img-circle avatar-md" src="{{ $origin->gravatar(64) }}" />
                        </a>
                    </div>
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $origin->name }}</h1>
                        <p>发表文章{{ $origin->articles->count() }}篇<i class="divider">&middot;</i>获得{{ $origin->likedUsers()->count() }}个喜欢</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
@can ('message', $origin)
                        <a href="{{ route('message.show', $origin->id) }}" class="btn btn-info btn-xs" role="button">
                            <i class="glyphicon glyphicon-send" aria-hidden="true"></i>站内信
                        </a>
@endcan
                        <a href="{{ route('user.show', $origin->id) }}" class="btn btn-success btn-xs" role="button">
                            个人主页<span class="glyphicon glyphicon-chevron-right offset-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
@elseif ($followings->isEmpty() !== true && $followings->first()->followable_type === App\Models\Column::class)
                <div class="media header-media">
@if (!$origin->thumbnails->isEmpty())
                    <div class="media-left">
                        <a href="{{ route('columns.show', $origin->id) }}">
                            <img class="media-object img-rounded avatar-md" src="{{ $origin->thumbnails->first()->url }}" />
                        </a>
                    </div>
@endif
                    <div class="media-body">
                        <h1 class="media-heading h2">{{ $origin->name }}</h1>
                        <p>收录文章{{ $origin->articles->count() }}篇<i class="divider">&middot;</i>有{{ $origin->follows->count() }}人关注</p>
                    </div>
                    <div class="media-right nowrap-landscape" id="user-buttons">
                        <button type="button" class="btn btn-info btn-xs">
                            <i class="glyphicon glyphicon-ok-circle" aria-hidden="true"></i>投稿
                        </button>
                        <a href="{{ route('columns.show', $origin->id) }}" class="btn btn-success btn-xs" role="button">
                            栏目主页<span class="glyphicon glyphicon-chevron-right offset-right" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
@endif
                <ul class="nav nav-tabs" id="inline-menu">
                    <li role="presentation" class="active">
                        <a href="#latest" id="latest-tab" data-toggle="tab" aria-controls="latest" aria-expanded="true" role="tab">
@if ($followings->isEmpty() !== true && $followings->first()->followable_type === App\Models\Column::class)
                            <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">收录</span>
@else
                            <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span>
@endif
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#commented" id="commented-tab" data-toggle="tab" aria-controls="commented" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i><span class="hidden-xs">最新</span>评论
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                            <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
@forelse ($latest as $article)
                        <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('articles.show', $article->id) }}">
                                    <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h4 class="media-heading media-title">
                                    <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h4>
                                <p>{{ $article->description }}</p>
                                <ul class="list-inline text-muted media-meta">
                                    <li>
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="sr-only">发布日期：</span>
                                        {{ $article->released_at->diffForHumans() }}
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $article->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) . '#comments' }}">
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
                            <p><strong>提示：</strong>Ta 还没有发表任何文章</p>
                        </div>
@endforelse
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="commented" aria-labelledby="commented-tab">
@forelse ($commented as $article)
                        <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('articles.show', $article->id) }}">
                                    <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h4 class="media-heading media-title">
                                    <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h4>
                                <p>{{ $article->description }}</p>
                                <ul class="list-inline text-muted media-meta">
                                    <li>
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="sr-only">发布日期：</span>
                                        {{ $article->released_at->diffForHumans() }}
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $article->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) . '#comments' }}">
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
                            <p><strong>提示：</strong>Ta 还没有得到过任何评论哦</p>
                        </div>
@endforelse
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="popular" aria-labelledby="popular-tab">
@forelse ($popular as $article)
                        <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                            <div class="media-left hidden-portrait">
                                <a href="{{ route('articles.show', $article->id) }}">
                                    <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
                                </a>
                            </div>
@endif
                            <div class="media-body">
                                <h4 class="media-heading media-title">
                                    <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h4>
                                <p>{{ $article->description }}</p>
                                <ul class="list-inline text-muted media-meta">
                                    <li>
                                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                        <span class="sr-only">发布日期：</span>
                                        {{ $article->released_at->diffForHumans() }}
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                            <span class="sr-only">浏览：</span>
                                            {{ $article->views }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-muted" href="{{ route('articles.show', $article->id) . '#comments' }}">
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
                            <p><strong>提示：</strong>Ta 还没有出现任何热门文章哦</p>
                        </div>
@endforelse
                    </div>
                </div>
            </div>
@stop