<div id="_delete-post" data-field-id="{{ Session::get('_delete-post') }}"></div>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            var message = $('#_delete-post').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
