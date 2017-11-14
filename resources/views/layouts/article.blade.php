@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column', $article->category->id) }}">{{ $article->category->name }}</a></li>
                    <li class="active">{{ $article->title }}</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="page-header">
                            <h1>{{ $article->title }}</h1>
                            <ul class="list-inline">
                                <li>发表于：{{ $article->released_at->diffForHumans() }}</li>
                                <li>作者：{{ $article->author->name or 'Anonymous' }}</li><!-- 关注作者 -->
                                <li>浏览：{{ $article->views }} 次</li>
                                <li>评论：{{ $article->comments()->count() }}</li>
                                <li>喜欢：{{ $article->favorites()->count() }}</li>
                                <li>赞赏：</li>
                            </ul>
                        </div>
                        <div class="page-content">
                            {!! $article->content !!}
                        </div>
@if (isset($article->tags) && !$article->tags->isEmpty())
                        <div id="tags">
@foreach ($article->tags as $tag)
                            <a href="{{ route('tag', $tag->id) }}" class="label label-default">{{ $tag->name }}</a>
@endforeach
{{--
                            <a href="{{ route('tag', 2) }}" class="label label-default">Testing</a>
                            <a href="{{ route('tag', 3) }}" class="label label-default">Delta</a>
                            <a href="{{ route('tag', 4) }}" class="label label-default">Alphabet</a>
--}}
                        </div>
@endif
                        <div id="preferences" class="row">
                            <div id="article-author" class="col-xs-12 col-md-10 col-md-offset-1">
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img alt="{{ $article->author->name }}" data-src="holder.js/64x64" class="media-object" src="{{ $article->author->gravatar(64) }}" data-holder-rendered="true">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="media-heading">{{ $article->author->name }}<small><a href="#" class="btn btn-success btn-xs" role="button"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>关注作者</a></small></h2>
                                            <p class="text-muted">发表文章：{{ $article->author->articles()->released()->count() }} 篇，被 xx 人关注，收获 xx 个喜欢</p>
                                        </div>
                                    </li>
                                </ul>
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
                                <div class="btn-toolbar" role="toolbar">
                                    <form method="POST" action="{{ $article->isLiked() ? route('favorite.revokeLike', $article->id) : route('favorite.addLike', $article->id) }}" class="btn-group" role="group">
                                        {{ csrf_field() }}
                                        {{ method_field($article->isLiked() ? 'DELETE' : 'PATCH') }}
                                        <button type="submit" class="btn btn-danger btn-sm btn-first">
                                            <span class="glyphicon {{ $article->isLiked() ? 'glyphicon-heart' : 'glyphicon-heart-empty' }}" aria-hidden="true"></span>喜欢
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ $article->isFavorite() ? route('favorite.revokeMark', $article->id) : route('favorite.addMark', $article->id) }}" class="btn-group" role="group">
                                        {{ csrf_field() }}
                                        {{ method_field($article->isFavorite() ? 'DELETE' : 'PATCH') }}
                                        <button type="submit" class="btn btn-warning btn-sm btn-last">
                                            <span class="glyphicon {{ $article->isFavorite() ? 'glyphicon-star' : 'glyphicon-star-empty' }}" aria-hidden="true"></span>收藏
                                        </button>
                                    </form>
                                </div>
                                {{--<a href="#" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-heart glyphicon-heart-empty" aria-hidden="true"></span>喜欢</a>--}}
                                {{--<a href="#" class="btn btn-warning btn-sm" role="button"><span class="glyphicon glyphicon-star glyphicon-star-empty" aria-hidden="true"></span>收藏</a>--}}
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
                                    <a href="{{ route('article', $prev->id) }}" title="{{ $prev->title }}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 上一篇</a>
@else
                                    <button class="btn btn-default pull-left disabled"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 上一篇</button>
@endif
                                </li>
                                <li class="next">
@if (isset($next))
                                    <a href="{{ route('article', $next->id) }}" title="{{ $next->title }}">下一篇 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
@else
                                    <button class="btn btn-default pull-right disabled">下一篇 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button>
@endif
                                </li>
                            </ul>
                        </nav>
                    </div>
@if (isset($article->comments) && !$article->comments->isEmpty())
                    <div class="col-xs-12">
                        <ul class="media-list">
@foreach ($article->comments as $comment)
                            <li class="media">
                                <div class="media-left">
                                    <img alt="{{ $comment->user->name }}" data-src="holder.js/64x64" class="media-object" src="{{ $comment->user->gravatar(64) }}" data-holder-rendered="true">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </li>
@endforeach
{{--
                            <li class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1YjZmN2M2YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjViNmY3YzZhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Media heading</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1YjZmN2M2YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjViNmY3YzZhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Media heading</h4>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                </div>
                            </li>
--}}
                        </ul>
                        <p class="text-right">
                            <a class="btn btn-info" href="{{ route('comments', $article->id) }}" role="button">查看更多评论</a>
                        </p>
                    </div>
@endif
                    <div class="col-xs-12">
                        @include('features.comment-form', ['modalLogin' => isset($modalLogin) ? $modalLogin : false])
                    </div>
@if (isset($modalLogin) && $modalLogin)
@unless (Auth::check())
                    @include('features.modal-login')
@endunless
@endif
                </div>
@stop

@section('sidebar')
                @parent
@stop

@if (isset($modalLogin) && $modalLogin && !Auth::check())
@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/js/ajax-login.js') }}"></script>
@stop
@endif