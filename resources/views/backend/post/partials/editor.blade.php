@section('unique-css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/talvbansal/mediamanager/css/media-manager.css')}}">
@stop

@include('media-manager::media.partials.file-picker')
<script type="text/javascript">
    $(document).ready(function () {
        var vm = new Vue({
            el: 'body',
            mixins: [FileManagerMixin],
            ready: function () {

                {{-- code to allow the multi-layered modal windows --}}
                $(document).on('show.bs.modal', '.modal', function () {
                    var zIndex = 1040 + (10 * $('.modal:visible').length);
                    $(this).css('z-index', zIndex);
                    setTimeout(function () {
                        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                    }, 0);
                });

                $('#easel-file-picker').on('shown.bs.modal', function () {
                    vm.loadFolder();
                });

                this.simpleMde = new SimpleMDE({
                    element: $("#editor")[0],
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        'link', 'image',
                        {
                            name: 'insertImage',
                            action: function (editor) {
                                this.insertIntoEditor = true;
                                this.openPicker();

                            }.bind(this),
                            className: "zmdi zmdi-collection-image-o",
                            title: "Insert Media Browser Image"
                        },
                        "|",
                        "preview", "side-by-side", "fullscreen", "|"
                    ]
                });

                $('.publish_date').mask('00/00/0000 00:00:00');
            },

            data: {
                isModal: true,
                pageImage: null,
                slug : null,
                title: null,
                simpleMde: null
            },

            methods: {

                slugify: function()
                {
                    this.slug = this.title.toLowerCase()
                            .trim()
                            .replace(/ /g, '-')
                            .replace(/[^\w\-]+/g, '')
                            .replace(/\-\-+/g, '-');
                },

                openPicker: function () {
                    this.reset();
                    $('#easel-file-picker').modal('show');
                },

                closePicker: function () {
                    this.reset();
                    this.insertIntoEditor = false;
                    $('#easel-file-picker').modal('hide');
                },

                selectFile: function (file) {
                    if (this.insertIntoEditor) {
                        var cm = this.simpleMde.codemirror;
                        var output = '[' + file.name + '](' + file.relativePath + ')';

                        if (this.isImage(file)) {
                            output = '!' + output;
                        }

                        cm.replaceSelection(output);
                    } else {
                        this.pageImage = file.relativePath;
                    }

                    this.closePicker();
                }
            }
        });
    });
</script>
