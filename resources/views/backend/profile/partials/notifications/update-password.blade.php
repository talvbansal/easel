<div id="_profile" data-field-id="{{ Session::get('_passwordUpdate') }}"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $(window).load(function(){
            function notify(message, type){
                $.growl({
                    message: message
                },{
                    type: type,
                    allow_dismiss: false,
                    label: 'Cancel',
                    className: 'btn-xs btn-inverse',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 2500,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    },
                    offset: {
                        x: 20,
                        y: 85
                    }
                });
            };

            setTimeout(function () {
                var message = $('#_profile').data("field-id");
                notify(message, 'inverse');
            }, 300)
        });
    });
</script>