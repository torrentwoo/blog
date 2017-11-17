@extends('shared.origin')

@section('carousel')
            <div class="col-xs-12 col-sm-12">
                <div id="home-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#home-carousel" data-slide-to="0"></li>
                        <li class="active" data-target="#home-carousel" data-slide-to="1"></li>
                        <li class="" data-target="#home-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img style="width:1140px;max-height:320px" data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNzc3OiM3NzcKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZTdlNSB0ZXh0IHsgZmlsbDojNzc3O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JlN2U1Ij48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/1140x400/auto/#777:#777" alt="1140x400">
                            <div class="carousel-caption">
                                <h3>First slide label</h3>
                                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item active">
                            <img style="width:1140px;max-height:320px" data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNjY2OiM2NjYKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZDAwOSB0ZXh0IHsgZmlsbDojNjY2O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JkMDA5Ij48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzY2NiIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/1140x400/auto/#666:#666" alt="1140x400">
                            <div class="carousel-caption">
                                <h3>Second slide label</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img style="width:1140px;max-height:320px" data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNTU1OiM1NTUKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZTQ3MSB0ZXh0IHsgZmlsbDojNTU1O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JlNDcxIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzU1NSIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/1140x400/auto/#555:#555" alt="1140x400">
                            <div class="carousel-caption">
                                <h3>Third slide label</h3>
                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#home-carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#home-carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
@stop

@section('content')
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
{{--
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="#" class="btn btn-default" role="button">栏目一</a>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <a href="{{ route('columns') }}" class="btn btn-link text-muted">
                                    <i>更多热门栏目</i>
                                    <span class="glyphicon glyphicon-menu-right"></span>
                                </a>
                            </div>
                        </div>
--}}
                        <ul id="home-columns" class="list-inline">
                            <li><a href="#" class="btn btn-default" role="button">栏目一</a></li>
                            <li><a href="#" class="btn btn-default btn-hasDiagram" role="button">
                                    <img class="media-object btn-diagram" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY1Nzc5ZDQ1ZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjU3NzlkNDVkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuOCI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="...">
                                    栏目一二
                                </a>
                            </li>
                            <li><a href="#" class="btn btn-default" role="button">栏目一</a></li>
                            <li><a href="#" class="btn btn-default" role="button">栏目一</a></li>
                            <li><a href="#" class="btn btn-default" role="button">栏目一</a></li>
                            <li><a href="#" class="btn btn-default" role="button">栏目一</a></li>
                            <li><a href="{{ route('columns') }}" class="btn btn-link text-muted">
                                    <i>更多热门栏目</i>
                                    <span class="glyphicon glyphicon-menu-right"></span>
                                </a>
                            </li>
                        </ul>
                        <hr />
                    </div>
@forelse ($articles as $article)
                    <div class="col-xs-6 col-lg-4">
                        <div class="thumbnail">
                            <a href="{{ route('article', $article->id) }}" title="{{ $article->title }}">
                                <img class="img-responsive" src="{{ $article->snapshot->thumbnail_url or $article->attachment->url }}" alt="{{ $article->title }}" />
                            </a>
                            <div class="caption">
                                <h2>{{ str_limit($article->title, 24) }}</h2>
                                <p>{{ str_limit($article->description, 32) }}</p>
                                <p class="text-right"><a class="btn btn-default" href="{{ route('article', $article->id) }}" role="button">View details &raquo;</a></p>
                            </div>
                        </div>
                    </div>
@empty
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p><strong>提示：</strong>没有找到任何发表过的文章内容</p>
                    </div>
@endforelse
                </div>
@stop

@section('scripts')
    <script type="text/javascript">
        console.warn('Here the extra section goes...')
    </script>
@stop