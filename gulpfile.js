var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false; // disable to generate source maps

elixir(function(mix) {
    mix.sass('app.scss', 'public/assets/css')
        .browserify('app.js', 'public/assets/js')
        .browserify('ajax-login.js', 'public/assets/js')
        .browserify('html5shiv.min.js', 'public/assets/js')
        .browserify('respond.min.js', 'public/assets/js')
        .browserify('ie10-viewport-bug-workaround.js', 'public/assets/js');
    mix.copy('resources/assets/sass/bootstrap-3.3.7.min.css', 'public/assets/css/bootstrap-3.3.7.min.css');
    mix.copy('resources/assets/sass/ie10-viewport-bug-workaround.css', 'public/assets/css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/assets/fonts');
});
