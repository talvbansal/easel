<div id="_login" data-field-id="{{ Session::get('_login') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_login').data("field-id");
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
