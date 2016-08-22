<div id="_delete-tag" data-field-id="{{ Session::get('_delete-tag') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_delete-tag').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
