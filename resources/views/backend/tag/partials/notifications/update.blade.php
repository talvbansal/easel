<div id="_update-tag" data-field-id="{{ Session::get('_update-tag') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_update-tag').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>