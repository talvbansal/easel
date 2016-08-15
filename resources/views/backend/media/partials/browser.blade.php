@include('easel::backend.media.partials.modals.file-picker')
@include('easel::backend.media.partials.js.file-manager-mixin')
<script type="text/javascript">

    $(document).ready(function () {

        var vm = new Vue({
            el: 'body',
            mixins: [fileManagerMixin],
            ready: function () {

                {{-- code to allow the multi-layered modal windows --}}
                $(document).on('show.bs.modal', '.modal', function () {
                    var zIndex = 1040 + (10 * $('.modal:visible').length);
                    $(this).css('z-index', zIndex);
                    setTimeout(function () {
                        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                    }, 0);
                });

                this.loadFolder();
            }
        });


    });
</script>
