<script type="text/javascript">

    $(document).ready(function () {

        var simpleMde; //make this global so that the image selection modal can access the editor instance once its created

        var vm = new Vue({
            el: 'body',
            data: {
                currentFile: null,
                folderName: null,
                folders: {},
                files: {},
                breadCrumbs: {},
                loading: true,
                insertIntoEditor: false,
                pageImage: {
                    'fullPath': '{{ $page_image }}',
                    'webPath': '{{ ( !empty($page_image) )? DIRECTORY_SEPARATOR . 'storage' . $page_image : null }}'
                }
            },

            ready: function () {
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

            methods: {

                openPicker: function () {
                    $('#easel-file-picker').modal('show');
                },

                closePicker: function () {
                    this.currentFile = null;
                    this.folderName = null;
                    this.folders = {};
                    this.files = {};
                    this.breadCrumbs = {};
                    this.insertIntoEditor = false;
                    $('#easel-file-picker').modal('hide');
                },

                loadFolder: function (path) {
                    if (!path) path = '';

                    this.loading = true;
                    this.currentFile = false;

                    this.$http.get('/admin/browser/index?path=' + path).then(
                            function (response) {
                                this.$set('loading', false);
                                this.$set('folderName', response.data.folderName);
                                this.$set('folders', response.data.subfolders);
                                this.$set('files', response.data.files);
                                this.$set('breadCrumbs', response.data.breadcrumbs);
                                this.$set('currentFile', null);
                                this.$set('selectedFile', null);
                            },
                            function (error) {
                                this.$set('loading', false);
                                this.$set('currentFile', null);
                                this.$set('selectedFile', null);
                            }
                    );
                },

                isImage: function (file) {
                    return file.mimeType.indexOf('image') != -1;
                },

                previewFile: function (file) {
                    this.currentFile = file;
                },

                selectFile: function (file) {

                    // this is pretty bad but not sure how else to achieve it without creating a custom markdown editor within vue
                    // which is possible but we'd lose the toolbars

                    if (this.insertIntoEditor) {
                        var cm = simpleMde.codemirror;
                        var output = '[' + file.name + '](' + file.webPath + ')'

                        if (this.isImage(file)) {
                            output = '!' + output;
                        }

                        cm.replaceSelection(output);
                    } else {
                        this.pageImage = file;
                    }

                    this.closePicker();
                },

                humanFileSize : function(size) {
                    var i = Math.floor( Math.log(size) / Math.log(1024) );
                    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
                }

            }
        });


        $('#easel-file-picker').on('shown.bs.modal', function () {
            vm.loadFolder();
        });

    });
</script>

@include('easel::backend.post.partials.modals.file-picker');