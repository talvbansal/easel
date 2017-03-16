<script>
    $(document).ready(function () {
        setTimeout(function () {
            var message = '{{ \Session::get('_delete-post') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
