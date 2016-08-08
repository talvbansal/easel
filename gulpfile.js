var elixir = require('laravel-elixir');

elixir(function (mix) {

    // SASS Files
    mix.sass('admin/admin.scss');
    mix.sass('auth/auth.scss');
    mix.sass('blog/blog.scss');
    mix.sass('easel.scss');

    // Vendor Files
    mix.copy('resources/assets/vendor/', 'public/vendor');

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

    // App CSS Files
    mix.styles([
        'custom.css',
        'app-1.css',
        'app-2.css'
    ], 'public/css/app.css');

    // Core Vendor JS Files

    mix.scripts([
        'jquery.min.js',
        'bootstrap.min.js'
    ], 'public/js/core.js');

    // Vendor JS Files
    mix.scripts([
        'moment.min.js',
        'autosize.min.js',
        'bootstrap-datetimepicker.min.js',
        'bootstrap-select.js',
        'chosen.jquery.min.js',
        'fileinput.min.js',
        'jquery.bootgrid.min.js',
        'jquery.mask.min.js',
        'jquery.mCustomScrollbar.concat.min.js',
        'lightgallery.min.js',
        'simplemde.min.js',
        'sweet-alert.min.js'
    ], 'public/js/vendor.js');

    // App JS Files
    mix.scripts([
        'waves.js',
        'bootstrap-growl.min.js',
        'functions.js',
        'easel.js'
    ], 'public/js/easel.js');

    mix.phpUnit();
});