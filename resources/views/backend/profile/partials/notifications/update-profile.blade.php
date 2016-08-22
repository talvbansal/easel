<div id="_profile" data-field-id="{{ Session::get('_profile') }}"></div>

<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = $('#_profile').data("field-id");
            systemNotification(message, 'inverse');
        }, 300)
    });
</script>
