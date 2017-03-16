<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ \Session::get('_login') }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
