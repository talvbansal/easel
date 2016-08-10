//front end javascript
$(document).ready(function() {

    //scroll to top
    if (($(window).height() + 100) < $(document).height()) {
        $('#top-link-block').removeClass('hidden').affix({
            // how far to scroll down before link "slides" into view
            offset: {top: 100}
        });
    }


});

Vue.filter('moment', function(value, format) {
    return moment.utc(value).local().format(format);
});

Vue.filter('humanFileSize',  function (size) {
    var i = Math.floor(Math.log(size) / Math.log(1024));
    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
});

function systemNotification(message, type){

    if( !type ) type = 'inverse';

    $.growl({
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
        delay: 2500,
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