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
            </div>

            @include('shared.sidebar')

        </div>

        <hr>

        @include('shared.footer')

    </div>

    <aside id="aside-widget" class="hidden-xs hidden-sm">
    </aside>

    <a href="javascript:void(0);" class="text-center" id="scrollToTop" role="button">
        <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
    </a>

    <script type="text/javascript" src="/assets/js/app.js"></script>
    <script type="text/javascript" src="/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript" src="/assets/js/socket.io-2.0.4.js"></script>
@if (Auth::check())
    <script type="text/javascript" src="/assets/js/app-notification.js"></script>
@endif
{{-- extra scripts, third-party plugins located here --}}
@yield('scripts')
</body>
</html>