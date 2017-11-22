@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active">
                                <a href="#latest" id="latest-tab" data-toggle="tab" aria-controls="latest" aria-expanded="true" role="tab">
                                    <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>最新<span class="hidden-xs">发表</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#commented" id="commented-tab" data-toggle="tab" aria-controls="commented" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-comment" aria-hidden="true"></i>热评<span class="hidden-xs">文章</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门<span class="hidden-xs">文章</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
@forelse ($latest as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" data-holder-rendered="true" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h4 class="media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h4>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li>
                                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">文章发布日期：</span>
                                                {{ $article->released_at->diffForHumans() }}
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
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
                                    <p><strong>提示：</strong>您还没有发表过任何文章哦</p>
                                </div>
@endforelse
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="commented" aria-labelledby="commented-tab">
@forelse ($comments as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" data-holder-rendered="true" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h4 class="media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h4>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li><span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">最新评论日期：</span>
                                                {{ $article->comments->first()->created_at->format('Y-m-d h:i A') }}
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
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
                                    <p><strong>提示：</strong>您还没有任何文章被评论哦</p>
                                </div>
@endforelse
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="popular" aria-labelledby="popular-tab">
@forelse ($popular as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" data-src="holder.js/150x120" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" data-holder-rendered="true" />
                                        </a>
                                    </div>
@endif
                                    <div class="media-body">
                                        <h4 class="media-heading media-title">
                                            <a href="{{ route('article.show', $article->id) }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                        </h4>
                                        <p>{{ $article->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li>
                                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                                <span class="sr-only">文章发布日期：</span>
                                                {{ $article->released_at->diffForHumans() }}
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) . '#comments' }}">
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
                                    <p><strong>提示：</strong>您还没有任何文章上热门哦</p>
                                </div>
@endforelse
                            </div>
                        </div>
                    </div>
@stop