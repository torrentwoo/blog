@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation">
                                <a href="#liked" id="liked-tab" data-toggle="tab" aria-controls="liked" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-heart" aria-hidden="true"></i><span class="hidden-xs">我</span>喜欢<span class="hidden-xs">的</span>
                                </a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="#favorites" id="favorites-tab" data-toggle="tab" aria-controls="favorites" aria-expanded="true" role="tab">
                                    <i class="glyphicon glyphicon-bookmark" aria-hidden="true"></i><span class="hidden-xs">我</span>收藏<span class="hidden-xs">的</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="liked" aria-labelledby="liked-tab">
@forelse ($liked as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
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
                                                <span class="sr-only">发布日期：</span>
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
                                    <p><strong>提示：</strong>您还没有喜欢过任何内容，不如先去本站的其他栏目逛逛，可能有您喜欢的内容哦</p>
                                </div>
@endforelse
                            </div>

                            <div role="tabpanel" class="tab-pane fade active in" id="favorites" aria-labelledby="favorites-tab">
@forelse ($favorites as $article)
                                <div class="media media-article">
@if (!$article->thumbnails->isEmpty())
                                    <div class="media-left hidden-portrait">
                                        <a href="{{ route('article.show', $article->id) }}">
                                            <img alt="{{ $article->title }}" class="media-object media-preview" src="{{  $article->thumbnails->first()->url }}" />
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
                                                <span class="sr-only">发布日期：</span>
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
                                    <p><strong>提示：</strong>您还没有收藏过任何内容，不如先去本站的其他栏目逛逛，可能有您感兴趣内容哦</p>
                                </div>
@endforelse
                            </div>
                        </div>
                    </div>
@stop