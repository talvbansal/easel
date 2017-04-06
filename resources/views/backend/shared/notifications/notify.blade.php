<script>
    $(document).ready(function(){
        setTimeout(function () {
            var message = '{{ Session::get($section) }}';
            systemNotification(message, 'inverse');
        }, 300);
    });
</script>
