<div id="_new-post" data-field-id="{{ Session::get('_new-post') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_new-post').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
