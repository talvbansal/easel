<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_new-tag') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
