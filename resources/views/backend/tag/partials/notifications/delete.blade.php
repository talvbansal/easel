<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_delete-tag') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
