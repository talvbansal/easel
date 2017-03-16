<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_delete-category') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
