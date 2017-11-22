@extends('users.archetype')

@section('subContent')
                    <div class="col-xs-12">
                        <ul class="nav nav-tabs" id="inline-menu">
                            <li role="presentation" class="active">
                                <a href="#oneself" id="oneself-tab" data-toggle="tab" aria-controls="oneself" aria-expanded="true" role="tab">
                                    <i class="glyphicon glyphicon-flag" aria-hidden="true"></i>我的<span class="hidden-xs">评论</span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#others" id="others-tab" data-toggle="tab" aria-controls="others" aria-expanded="false" role="tab">
                                    <i class="glyphicon glyphicon-comment" aria-hidden="true"></i>评论<span class="hidden-xs">我的</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="oneself" aria-labelledby="oneself-tab">
@forelse ($oneself as $comment)
                                <div class="well well-quirk">
                                    <ul class="list-inline">
                                        <li><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></li>
                                        <li>@if (!$comment->parent_id)发表@else回复@endif了评论</li>
                                        <li class="text-muted">{{ $comment->created_at->format('n/j h:s a') }}</li>
                                    </ul>
                                    <p>{{ $comment->content }}</p>
                                    <blockquote class="small text-muted">
@if ($comment->commentable_type === \App\Models\Article::class)
                                        <h4><a href="{{ route('article.show', $comment->commentable->id) }}">{{ $comment->commentable->title }}</a></h4>
                                        <p>{{ str_limit($comment->commentable->content, 320) }}</p>
                                        <ul class="list-inline text-muted">
                                            <li><a href="{{ route('user.show', $comment->commentable->author->id) }}">{{ $comment->commentable->author->name }}</a></li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $comment->commentable->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                                    <span class="sr-only">浏览：</span>
                                                    {{ $comment->commentable->views }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-muted" href="{{ route('article.show', $comment->commentable->id) . '#comments' }}">
                                                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                                                    <span class="sr-only">评论：</span>
                                                    {{ $comment->commentable->comments->count() }}
                                                </a>
                                            </li>
                                            <li><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                                                <span class="sr-only">喜欢：</span>
                                                {{ $comment->commentable->likes->count() }}
                                            </li>
                                        </ul>
@elseif ($comment->commentable_type === \App\Models\Comment::class)
                                        <p>{{ str_limit($comment->commentable->content, 320) }}</p>
                                        <ul class="list-inline text-muted">
                                            <li><a href="{{ route('user.show', $comment->commentable->commentator->id) }}">{{ $comment->commentable->commentator->name }}</a></li>
                                            <li>
                                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                                                <span class="sr-only">赞：</span>
                                                0
                                            </li>
                                            <li>
                                                <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                                                <span class="sr-only">踩：</span>
                                                0
                                            </li>
                                        </ul>
@endif
                                    </blockquote>
                                </div>
@empty
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><strong>提示：</strong>您还没有发表过任何评论，不如先去本站的其他栏目逛逛，可能有您感兴趣内容哦</p>
                                </div>
@endforelse
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="others" aria-labelledby="others-tab">
@forelse ($others as $comment)
@empty
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><strong>提示：</strong>您还没有得到过任何评论哦</p>
                                </div>
@endforelse
                            </div>
                        </div>
                    </div>
@stop