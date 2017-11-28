@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active">
                                <a href="#activities" id="activities-tab" data-toggle="tab" aria-controls="activities" aria-expanded="true" role="tab">
                                    <i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>动态
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#popular" id="popular-tab" data-toggle="tab" aria-controls="popular" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-fire" aria-hidden="true"></i>热门
                                </a>
                            </li><!-- 我的热门文章 -->
                            <li role="presentation">
                                <a href="#comments" id="popular-tab" data-toggle="tab" aria-controls="comments" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-comment" aria-hidden="true"></i>评论
                                </a>
                            </li><!-- 别人评论我的 -->
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="activities" aria-labelledby="activities-tab">
@forelse ($activities as $activity)
@if ($activity->activable_type === App\Models\Article::class)
@if ($activity->activable)
                                <div class="my-moment"><!-- 发表文章 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">发表了文章</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading media-title">
                                                <a href="{{ route('article.show', $activity->activable->id) }}">{{ $activity->activable->title }}</a>
                                            </h3>
                                            <p>{{ $activity->activable->description }}</p>
                                            <ul class="list-inline text-muted media-meta">
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.show', $activity->activable->id) }}">
                                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        <span class="sr-only">浏览：</span>
                                                        {{ $activity->activable->views }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.comments', $activity->activable->id) }}">
                                                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                        <span class="sr-only">评论：</span>
                                                        {{ $activity->activable->comments->count() }}
                                                    </a>
                                                </li>
                                                <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                    <span class="sr-only">喜欢：</span>
                                                    {{ $activity->activable->likes->count() }}
                                                </li>
                                            </ul>
                                        </div>
@if ($activity->activable->thumbnails->isEmpty() !== true)
                                        <div class="media-right hidden-portrait">
                                            <a href="{{ route('article.show', $activity->activable->id) }}">
                                                <img class="media-object media-preview" src="{{ $activity->activable->thumbnails->first()->url }}" />
                                            </a>
                                        </div>
@endif
                                    </div>
                                </div>
@endif
@elseif ($activity->activable_type === App\Models\Like::class)
@if ($activity->activable)
                                <div class="my-moment"><!-- 喜欢文章 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">喜欢了文章</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading media-title">
                                                <a href="{{ route('article.show', $activity->activable->likable->id) }}">{{ $activity->activable->likable->title }}</a>
                                            </h3>
                                            <p>{{ $activity->activable->likable->description }}</p>
                                            <ul class="list-inline text-muted media-meta">
                                                <li>
                                                    <a href="{{ route('user.show', $activity->activable->likable->author->id) }}">{{ $activity->activable->likable->author->name }}</a>
                                                </li>
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.show', $activity->activable->likable->id) }}">
                                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        <span class="sr-only">浏览：</span>
                                                        {{ $activity->activable->likable->views }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.comments', $activity->activable->likable->id) }}">
                                                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                        <span class="sr-only">评论：</span>
                                                        {{ $activity->activable->likable->comments->count() }}
                                                    </a>
                                                </li>
                                                <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                    <span class="sr-only">喜欢：</span>
                                                    {{ $activity->activable->likable->likes->count() }}
                                                </li>
                                            </ul>
                                        </div>
@if ($activity->activable->likable->thumbnails->isEmpty() !== true)
                                        <div class="media-right hidden-portrait">
                                            <a href="{{ route('article.show', $activity->activable->likable->id) }}">
                                                <img class="media-object media-preview" src="{{ $activity->activable->likable->thumbnails->first()->url }}" />
                                            </a>
                                        </div>
@endif
                                    </div>
                                </div>
@endif
@elseif ($activity->activable_type === App\Models\Favorite::class)
@if ($activity->activable)
                                <div class="my-moment"><!-- 收藏文章 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">收藏了文章</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading media-title">
                                                <a href="{{ route('article.show', $activity->activable->favorable->id) }}">{{ $activity->activable->favorable->title }}</a>
                                            </h3>
                                            <p>{{ $activity->activable->favorable->description }}</p>
                                            <ul class="list-inline text-muted media-meta">
                                                <li>
                                                    <a href="{{ route('user.show', $activity->activable->favorable->author->id) }}">{{ $activity->activable->favorable->author->name }}</a>
                                                </li>
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.show', $activity->activable->favorable->id) }}">
                                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                        <span class="sr-only">浏览：</span>
                                                        {{ $activity->activable->favorable->views }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="text-muted" href="{{ route('article.comments', $activity->activable->favorable->id) }}">
                                                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                        <span class="sr-only">评论：</span>
                                                        {{ $activity->activable->favorable->comments->count() }}
                                                    </a>
                                                </li>
                                                <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                    <span class="sr-only">喜欢：</span>
                                                    {{ $activity->activable->favorable->likes->count() }}
                                                </li>
                                            </ul>
                                        </div>
@if ($activity->activable->favorable->thumbnails->isEmpty() !== true)
                                        <div class="media-right hidden-portrait">
                                            <a href="{{ route('article.show', $activity->activable->favorable->id) }}">
                                                <img class="media-object media-preview" src="{{ $activity->activable->favorable->thumbnails->first()->url }}" />
                                            </a>
                                        </div>
@endif
                                    </div>
                                </div>
@endif
@elseif ($activity->activable_type === App\Models\Vote::class)
@if ($activity->activable)
                                <div class="my-moment"><!-- 点赞评论 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">点赞了评论</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <p>{{ $activity->activable->votable->content }}</p>
                                    <blockquote class="text-muted">
                                        <p class="small">
                                            <a href="{{ route('user.show', $activity->activable->votable->commentator->id) }}">{{ $activity->activable->votable->commentator->name }}</a>
                                            <span class="offset-right">评论自</span>
                                            <a href="{{ route('article.comments', $activity->activable->votable->commentable->id) }}#mark-{{ $activity->activable->votable->id }}">{{ $activity->activable->votable->commentable->title }}</a>
                                        </p>
                                    </blockquote>
                                </div>
@endif
@elseif ($activity->activable_type === App\Models\Comment::class)
@if ($activity->activable)
@if ($activity->activable->commentable_type === App\Models\Article::class)
                                <div class="my-moment"><!-- 发表评论 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">发表了评论</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <p>{{ $activity->activable->content }}</p>
                                    <blockquote class="text-muted">
                                        <h4><a href="{{ route('article.show', $activity->activable->commentable->id) }}">{{ $activity->activable->commentable->title }}</a></h4>
                                        <p>{{ $activity->activable->commentable->description }}</p>
                                        <ul class="list-inline text-muted media-meta">
                                            <li>
                                                <a href="{{ route('user.show', $activity->activable->commentable->author->id) }}">{{ $activity->activable->commentable->author->name }}</a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $activity->activable->commentable->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $activity->activable->commentable->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.comments', $activity->activable->commentable->id) }}">
                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                    <span class="sr-only">评论：</span>
                                                    {{ $activity->activable->commentable->comments->count() }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                <span class="sr-only">喜欢：</span>
                                                {{ $activity->activable->commentable->likes->count() }}
                                            </li>
                                        </ul>
                                    </blockquote>
                                </div>
@elseif ($activity->activable->commentable_type === App\Models\Comment::class)
                                <div class="my-moment"><!-- 回复评论 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">回复了评论</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <p>{{ $activity->activable->content }}</p>
                                    <blockquote class="text-muted">
                                        <p>{{ $activity->activable->commentable->content }}</p>
                                        <p class="small">
                                            <a href="{{ route('user.show', $activity->activable->commentable->commentator->id) }}">{{ $activity->activable->commentable->commentator->name }}</a>
                                            <span class="offset-right">评论自</span>
                                            <a href="{{ route('article.show', $activity->activable->commentable->commentable->id) }}">{{ $activity->activable->commentable->commentable->title }}</a>
                                        </p>
                                    </blockquote>
                                </div>
@endif
@endif
@elseif ($activity->activable_type === App\Models\Follow::class)
@if ($activity->activable)
@if ($activity->activable->followable_type === App\Models\Column::class)
                                <div class="my-moment"><!-- 关注栏目 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">关注了专栏</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <div class="well">
                                        <div class="media">
@if ($activity->activable->followable->thumbnails->isEmpty() !== true)
                                            <div class="media-left">
                                                <a href="{{ route('column.show', $activity->activable->followable->id) }}">
                                                    <img class="media-object img-rounded well-media-preview" src="{{ $activity->activable->followable->thumbnails->first()->url }}" />
                                                </a>
                                            </div>
@endif
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $activity->activable->followable->name }}</h4>
                                                <small class="text-muted">收录文章 {{ $activity->activable->followable->articles->count() }} 篇<i class="divider">&middot;</i>被 {{ $activity->activable->followable->follows->count() }} 人关注</small>
                                            </div>
                                        </div>
                                        <hr />
                                        <p class="text-muted">{{ $activity->activable->followable->description }}</p>
                                    </div>
                                </div>
@elseif ($activity->activable->followable_type === App\Models\User::class)
                                <div class="my-moment"><!-- 关注作者 -->
                                    <ul class="list-inline moment-driver">
                                        <li><img class="img-circle avatar-xs" src="{{ $activity->driver->gravatar(32) }}" /></li>
                                        <li>{{ $activity->driver->name }}</li>
                                        <li class="text-muted">关注了作者</li>
                                        <li class="small text-muted">{{ $activity->created_at->format('Y-m-d g:i a') }}</li>
                                    </ul>
                                    <div class="well">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="{{ route('user.show', $activity->activable->followable->id) }}">
                                                    <img class="media-object img-circle well-media-preview" src="{{ $activity->activable->followable->gravatar(48) }}" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $activity->activable->followable->name }}</h4>
                                                <small class="text-muted">发布了 {{ $activity->activable->followable->articles->count() }} 篇文章，被 {{ $activity->activable->followable->followingUsers->count() }} 人关注，获得 {{ $activity->activable->followable->likedUsers()->count() }} 个喜欢</small>
                                            </div>
                                        </div>
                                        <hr />
                                        <p class="text-muted">{{ $activity->activable->followable->introduction or '作者没有填写“个人简介”...' }}</p>
                                    </div>
                                </div>
@endif
@endif
@endif
@empty
                                <p class="text-muted">自入驻以来，您就没有做过任何事；在动态这件事上，我们无能为力……</p>
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
                                                <a class="text-muted" href="{{ route('article.comments', $article->id) }}">
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
                            <div role="tabpanel" class="tab-pane fade" id="comments" aria-labelledby="comments-tab">
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
                                                {{ $article->comments->first()->created_at->format('Y-m-d g:i a') }}
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $article->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $article->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.comments', $article->id) }}">
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
                        </div>
                    </div>
@stop