@extends('shared.origin')

@section('content')
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('column', $column->id) }}">{{ $column->name }}</a></li>
                    <li class="active">{{ $article->title }}</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="page-header">
                            <h1>{{ $article->title }}</h1>
                            <ul class="list-inline">
                                <li>发表于：{{ $article->released_at->diffForHumans() }}</li>
                                <li>作者：{{ $article->author or 'Admin' }}</li>
                                <li>浏览：{{ $article->visited }} 次</li>
                            </ul>
                        </div>
                        <div class="page-content">
                            {!! $article->content !!}
                        </div>
@if (isset($tags))
                        <div id="tagcloud">
@foreach ($tags as $tag)
                            <a href="{{ route('tag', $tag->id) }}" class="label label-default">{{ $tag->name }}</a>
@endforeach
{{--
                            <a href="{{ route('tag', 2) }}" class="label label-default">Testing</a>
                            <a href="{{ route('tag', 3) }}" class="label label-default">Delta</a>
                            <a href="{{ route('tag', 4) }}" class="label label-default">Alphabet</a>
--}}
                        </div>
@endif
                        <nav aria-label="Page navigation">
                            <ul class="pager">
@if (isset($prev))
                                <li class="previous"><a href="{{ route('article', $prev->id) }}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 上一篇</a></li>
@else
                                <li class="previous disabled"><a href="#"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 上一篇</a></li>
@endif
@if (isset($next))
                                <li class="next"><a href="{{ route('article', $next->id) }}">下一篇 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>
@else
                                <li class="next disabled"><a href="#">下一篇 <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>
@endif
                            </ul>
                        </nav>
                    </div>
@if (isset($comments))
                    <div class="col-xs-12">
                        <ul class="media-list">
@for ($i = 0, $j = $comments->count(); $i < $j; $i++)
@if ($i <= 4)
                            <li class="media">
                                <div class="media-left">
                                    <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1YjZmN2M2YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjViNmY3YzZhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $comments[$i]->user->name }} <small>{{ $comments[$i]->created_at->diffForHumans() }}</small></h4>
                                    <p>{{ $comments[$i]->content }}</p>
                                </div>
                            </li>
@endif
@endfor
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