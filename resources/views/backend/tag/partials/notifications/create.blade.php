<div id="_new-tag" data-field-id="{{ Session::get('_new-tag') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_new-tag').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
