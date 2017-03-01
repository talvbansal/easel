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
mix.sass('resources/assets/sass/auth/auth.scss', 'public/css');
mix.sass('resources/assets/sass/blog/blog.scss', 'public/css');
mix.sass('resources/assets/sass/easel.scss', 'public/css');

// CSS files...

// Media manager assets...
mix.copy('vendor/talvbansal/media-manager/public/fonts/', 'fonts/');
mix.copy('resources/assets/images', 'public/images/');

// Vendor CSS Files
mix.styles([
    'resources/assets/css/chosen.min.css',
    'resources/assets/css/lightgallery.css',
    'resources/assets/css/jquery.mCustomScrollbar.min.css',
    'resources/assets/css/material-design-iconic-font.min.css',
    'resources/assets/css/animate.min.css',
    'resources/assets/css/sweet-alert.min.css'
], 'public/css/vendor.css');


// Vendor JS Files

mix.js('resources/assets/js/easel-app.js', 'public/js/easel-app.js')
    .js('resources/assets/js/easel-start.js', 'public/js/easel-start.js');
