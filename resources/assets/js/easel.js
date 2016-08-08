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