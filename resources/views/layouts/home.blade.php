@extends('shared.origin')

@section('content')
                <div id="home-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#home-carousel" data-slide-to="0"></li>
                        <li class="active" data-target="#home-carousel" data-slide-to="1"></li>
                        <li class="" data-target="#home-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNzc3OiM3NzcKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZTdlNSB0ZXh0IHsgZmlsbDojNzc3O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JlN2U1Ij48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/900x500/auto/#777:#777" alt="900x500">
                            <div class="carousel-caption">
                                <h3>First slide label</h3>
                                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item active">
                            <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNjY2OiM2NjYKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZDAwOSB0ZXh0IHsgZmlsbDojNjY2O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JkMDA5Ij48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzY2NiIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/900x500/auto/#666:#666" alt="900x500">
                            <div class="carousel-caption">
                                <h3>Second slide label</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNTU1OiM1NTUKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWY5ZWNiZTQ3MSB0ZXh0IHsgZmlsbDojNTU1O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZjllY2JlNDcxIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzU1NSIvPjxnPjx0ZXh0IHg9IjMzNC41IiB5PSIyNzAuNCI+OTAweDUwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-src="holder.js/900x500/auto/#555:#555" alt="900x500">
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
                <div class="row">
@if (isset($articles))
@foreach ($articles as $article)
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
                    </div><!--/.col-xs-6.col-lg-4-->
@endforeach
@endif
{{--
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 2) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 3) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 4) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 5) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 6) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
--}}
                </div><!--/row-->
@stop

@section('scripts')
    <script type="text/javascript">
        console.warn('plugin was launched')
    </script>
@stop