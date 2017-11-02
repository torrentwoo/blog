@extends('shared.origin')

@section('content')
                <div class="jumbotron">
                    <h1>Hello, world!</h1>
                    <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-lg-4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="{{ route('article', 1) }}" role="button">View details &raquo;</a></p>
                    </div><!--/.col-xs-6.col-lg-4-->
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
                </div><!--/row-->
@stop

@section('scripts')
    <script type="text/javascript">
        console.warn('plugin was launched')
    </script>
@stop