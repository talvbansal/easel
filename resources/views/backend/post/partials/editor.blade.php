@include('easel::backend.media.partials.file-picker')
<script type="text/javascript">

    $(document).ready(function () {

        var simpleMde;
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

                $('#easel-file-picker').on('shown.bs.modal', function () {
                    vm.loadFolder();
                });

                simpleMde = new SimpleMDE({
                    element: $("#editor")[0],
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        'link',
                        {
                            name: 'insertImage',
                            action: function (editor) {
                                this.insertIntoEditor = true;
                                this.openPicker();

                            }.bind(this),
                            className: "fa fa-image",
                            title: "Insert Image"
                        },
                        "|",
                        "preview", "side-by-side", "fullscreen", "|"
                    ]
                });

                $('.publish_date').mask('00/00/0000 00:00:00');
            },

            data: {
                pageImage: null,
                isModal: true
            },

            computed: {
                webPathToPostImage: function () {
                    return ( this.pageImage.length > 0 ) ? '/storage/' + this.pageImage : null;
                }
            },

            methods: {
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

                    // this is pretty bad but not sure how else to achieve it without creating a custom markdown editor within vue
                    // which is possible but we'd lose the toolbars
                    if (this.insertIntoEditor) {
                        var cm = simpleMde.codemirror;
                        var output = '[' + file.name + '](' + file.webPath + ')';

                        if (this.isImage(file)) {
                            output = '!' + output;
                        }

                        cm.replaceSelection(output);
                    } else {
                        this.pageImage = file.fullPath;
                    }

                    this.closePicker();
                }
            }
        });


    });
</script>
