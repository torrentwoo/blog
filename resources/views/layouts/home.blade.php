@extends('shared.origin')

@section('content')
                <div class="jumbotron">
                    <h1>Hello, world!</h1>
                    <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
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