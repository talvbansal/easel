<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_update-category') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
