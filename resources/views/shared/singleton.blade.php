@include('shared.meta', ['headMeta' => (isset($headMeta) ? $headMeta : null)])

<body>
    @include('shared.nav')

    <div class="container">

        @include('features.flash-message')

        <div class="row">
@yield('content')
        </div>

        <hr />

        @include('shared.footer')

    </div>
    <script type="text/javascript" src="/assets/js/app.js"></script>
{{-- extra scripts, third-party plugins located here --}}
@yield('scripts')
</body>
</html>