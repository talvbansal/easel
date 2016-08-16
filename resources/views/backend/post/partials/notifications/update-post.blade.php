<div id="_update-post" data-field-id="{{ Session::get('_update-post') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_update-post').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>