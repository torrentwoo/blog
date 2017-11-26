@include('shared.meta', ['headMeta' => (isset($headMeta) ? $headMeta : null)])

<body>
    @include('shared.nav')

    <div class="container">

        @include('features.flash-message')

        <div class="row row-offcanvas row-offcanvas-right">
@yield('carousel')
            <div class="col-xs-12 col-sm-9">
                <p class="clearfix visible-xs">
                    <button type="button" class="pull-right btn btn-primary btn-xs" data-toggle="offcanvas">切换至侧边栏</button>
                </p>
@yield('content')
            </div><!--/.col-xs-12.col-sm-9-->

            @include('shared.sidebar')

        </div><!--/row-->

        <hr>

        @include('shared.footer')
{{--
        <aside id="aside-widget" class="hidden-xs hidden-sm">
            <p>aside widget goes here...</p>
        </aside>
--}}

    </div><!--/.container-->
    <script type="text/javascript" src="/assets/js/app.js"></script>
    <script type="text/javascript" src="/assets/js/ie10-viewport-bug-workaround.js"></script>
{{-- extra scripts, third-party plugins located here --}}
@yield('scripts')
</body>
</html>