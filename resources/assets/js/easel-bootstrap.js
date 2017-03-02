
window._ = require('lodash');
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Moment is a javascript library that we can use to format dates
 * It's similar to Carbon in PHP so we mostly use it to format
 * dates that are returned from our Laravel Eloquent models
 */
window.moment = require('moment');

/**
 * Other easel dependencies
 */
require('./../../../vendor/talvbansal/media-manager/public/js/media-manager');
window.autosize = require('autosize');
window.hammer = require('hammerjs');
window.chosen = require('chosen');
window.simpleMde = require('simplemde');
window.Waves = require('node-waves');
window.bootgrid = require('./jquery.bootgrid');
require('bootstrap-growl');
require('bootstrap-select');
require('eonasdan-bootstrap-datetimepicker');
require('malihu-custom-scrollbar-plugin');

require('./functions.js');
require('./fileinput.min.js');
require('./jquery.mask.min.js');
require('./lightgallery.min.js');
require('./sweet-alert.min.js');

// Create a global notification method...
global.systemNotification = function(message, type){
    if( !type ) type = 'inverse';

    $.notify({
        message: message
    },{
        type: type,
        allow_dismiss: false,
        label: 'Cancel',
        className: 'btn-xs btn-inverse',
        placement: {
            from: 'top',
            align: 'right'
        },
        delay: 3800,
        z_index: 1061,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        offset: {
            x: 20,
            y: 85
        }
    });
}
