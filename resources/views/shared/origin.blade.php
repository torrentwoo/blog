@include('shared.meta', ['extraMeta' => (isset($extraMeta) ? $extraMeta : null)])

<body>
    @include('shared.nav')

    <div class="container">

        @include('shared.message')

        <div class="row row-offcanvas row-offcanvas-right">
            <div class="col-xs-12 col-sm-9">
                <p class="pull-right visible-xs">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
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
{{-- extra scripts, third-party plugins located here --}}
@yield('scripts')
</body>
</html>