<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_update-post') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
