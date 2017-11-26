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
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('article.show', $activity->activable->id) }}">{{ $activity->activable->title }}</a></dt>
                                    <dd class="occurred">发表了一篇文章<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ $activity->activable->description }}</dd>
                                </dl>
@elseif ($activity->activable_type === App\Models\Column::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('column.show', $activity->activable->id) }}">{{ $activity->activable->name }}</a></dt>
                                    <dd class="occurred">创建了一个栏目<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ $activity->activable->description }}</dd>
                                </dl>
@elseif ($activity->activable_type === App\Models\Comment::class)
@if ($activity->activable->commentable_type === App\Models\Article::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('article.comments', $activity->activable->commentable_id) }}#mark-{{ $activity->activable->id }}">{{ App\Models\Article::find($activity->activable->commentable_id)->title }}</a></dt>
                                    <dd class="occurred">发表了一个评论<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ str_limit($activity->activable->content, 140) }}</dd>
                                </dl>
@elseif ($activity->activable->commentable_type === App\Models\Comment::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('article.comments', $activity->activable->commentable_id) }}#mark-{{ $activity->activable->id }}">{{ App\Models\Article::find($activity->activable->commentable_id)->title }}</a></dt>
                                    <dd class="occurred">回复了一个评论<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ str_limit($activity->activable->content, 140) }}</dd>
                                </dl>
@endif
@elseif ($activity->activable_type === App\Models\Favorite::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('article.show', $activity->activable->favorable_id) }}">{{ App\Models\Article::find($activity->activable->favorable_id)->title }}</a></dt>
                                    <dd class="occurred">收藏了一篇文章<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ $activity->activable->description }}</dd>
                                </dl>
@elseif ($activity->activable_type === App\Models\Follow::class)
@if ($activity->activable->followable_type === App\Models\User::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('user.show', $activity->activable->followable_id) }}">{{ App\Models\User::find($activity->activable->followable_id)->name }}</a></dt>
                                    <dd class="occurred">关注了一个作者<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ App\Models\User::find($activity->activable->followable_id)->introduction }}</dd>
                                </dl>
@elseif ($activity->activable->followable_type === App\Models\Column::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('column.show', $activity->activable->followable_id) }}">{{ App\Models\Column::find($activity->activable->followable_id)->name }}</a></dt>
                                    <dd class="occurred">关注了一个栏目<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ App\Models\Column::find($activity->activable->followable_id)->description }}</dd>
                                </dl>
@endif
@elseif ($activity->activable_type === App\Models\Like::class)
                                <dl class="well my-moment">
                                    <dt><a href="{{ route('article.show', $activity->activable->likable_id) }}">{{ App\Models\Article::find($activity->activable->likable_id)->title }}</a></dt>
                                    <dd class="occurred">喜欢了一篇文章<small class="offset-right">{{ $activity->created_at->diffForHumans() }}</small></dd>
                                    <dd>{{ App\Models\Article::find($activity->activable->likable_id)->description }}</dd>
                                </dl>
@elseif ($activity->activable_type === App\Models\User::class)
                                <dl class="well my-moment">
                                    <dd><b>{{ $activity->activable->name }}</b><span class="divider offset-left offset-right">入驻本站</span><small>{{ $user->created_at->format('Y-m-d h:i a') }}</small></dd>
                                </dl>
@endif
@empty
                                <dl class="well my-moment">
                                    <dd><b>{{ Auth::user()->nickname or Auth::user()->name }}</b><span class="divider offset-left offset-right">入驻本站</span><small>{{ Auth::user()->created_at->format('Y-m-d h:i a') }}</small></dd>
                                </dl>
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
                        </div>
                    </div>
@stop