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
    // Compile sass to css - css framework|each dependence
    //mix.sass('app.scss', 'public/assets/css'); // here no need compile for now

    // Merge css files - style tweaks
    mix.styles([
        'offcanvas.css',
        'tweaks.css'
    ], 'public/assets/css/ui-merged.css');

    // Copy specified resources
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/assets/fonts');

    // Javascript stuff
    mix.browserify('app.js', 'public/assets/js')
        .browserify('ajax-login.js', 'public/assets/js')
        .browserify('app-chat.js', 'public/assets/js')
        .browserify('app-notification.js', 'public/assets/js')
        .browserify('app-chatNotification.js', 'public/assets/js');

    // Version controller - file(s) are relative to /public directory
    mix.version([
        'assets/css/ui-merged.css'
    ]);
});
