const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Sass files...
mix.sass('resources/assets/sass/admin/admin.scss', 'public/css');
mix.sass('resources/assets/sass/auth/auth.scss', 'public/css');
mix.sass('resources/assets/sass/blog/blog.scss', 'public/css');
mix.sass('resources/assets/sass/easel.scss', 'public/css');

// CSS files...
mix.styles([
    'resources/assets/css/custom.css',
    'resources/assets/css/app-1.css',
    'resources/assets/css/app-2.css'
], 'public/css/core.css');

// Media manager assets...
mix.copy('vendor/talvbansal/media-manager/public/fonts/', 'fonts');

// Vendor CSS Files
mix.styles([
    'bootstrap-datetimepicker.css',
    'chosen.min.css',
    'jquery.bootgrid.min.css',
    'lightgallery.css',
    'bootstrap-select.min.css',
    'jquery.mCustomScrollbar.min.css',
    'material-design-iconic-font.min.css',
    'animate.min.css',
    'sweet-alert.min.css',
    'simplemde.min.css'
], 'public/css/vendor.css');

// Core Vendor JS Files

mix.scripts([
    'jquery.min.js',
    'bootstrap.min.js',
], 'public/js/core.js');

// Vendor JS Files
mix.scripts([
    'bootstrap-datetimepicker.min.js',
    'fileinput.min.js',
    'jquery.bootgrid.min.js',
    'jquery.mask.min.js',
    'jquery.mCustomScrollbar.concat.min.js',
    'lightgallery.min.js',
    'sweet-alert.min.js'
], 'public/js/vendor.js');

// App JS Files
mix.scripts([
    'waves.js',
    'bootstrap-growl.min.js',
    'functions.js',
    'easel.js'
], 'public/js/easel.js');

mix.js('resources/assets/js/easel-app.js', 'public/js/easel-app.js')
    .js('resources/assets/js/easel-start.js', 'public/js/easel-start.js');
