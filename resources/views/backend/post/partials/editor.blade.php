<script type="text/javascript">

    $(document).ready(function () {

        var simpleMde;

        {{-- code to allow the multi-layered modal windows --}}
        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function () {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });

        var vm = new Vue({
            el: 'body',
            data: {
                currentFile: null,
                currentPath: null,
                folderName: null,
                folders: {},
                files: {},
                breadCrumbs: {},
                loading: true,
                insertIntoEditor: false,
                pageImage: {
                    'fullPath': '{{ $page_image }}',
                    'webPath': '{{ ( !empty($page_image) )? DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $page_image : null }}'
                },
                newFolderName: null,
                fileUploadFormData: new FormData(),
                newItemName: null
            },

            computed: {
                itemsCount: function () {
                    return this.visibleFiles.length + Object.keys(this.folders).length;
                },

                visibleFiles: function () {
                    return this.files.filter(function (item) {
                        return (item.name.substring(0, 1) != ".");
                    });
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

                reset: function () {
                    this.currentFile = null;
                    this.currentPath = null;
                    this.folderName = null;
                    this.folders = {};
                    this.files = {};
                    this.breadCrumbs = {};
                    this.newFolderName = null;
                    this.newItemName = null;
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

                responseError: function (response) {

                    if (response.data.error) {
                        systemNotification(response.data.error);
                    }

                    this.$set('loading', false);
                    this.$set('currentFile', null);
                    this.$set('selectedFile', null);
                },

                loadFolder: function (path) {
                    if (!path) {
                        path = ( this.currentPath )? this.currentPath : '';
                    }

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
                                this.$set('currentPath', response.data.folder);
                                this.$set('selectedFile', null);
                                this.$set('newFolderName', null);
                                this.$set('newItemName', null);
                            },
                            function (response) {
                                this.responseError(response);
                            }
                    );
                },

                isImage: function (file) {
                    return file.mimeType.indexOf('image') != -1;
                },

                isFolder: function (file) {
                    return (typeof file === 'string');
                },

                previewFile: function (file) {
                    this.currentFile = file;
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
                        this.pageImage = file;
                    }

                    this.closePicker();
                },

                deleteItem: function () {

                    if (this.isFolder(this.currentFile)) {
                        return this.deleteFolder();
                    }
                    return this.deleteFile();
                },

                deleteFile: function () {
                    if (this.currentFile) {
                        this.loading = true;

                        this.$http.delete('/admin/browser/delete', {body: {'path': this.currentFile.fullPath}}).then(
                                function (response) {
                                    systemNotification(response.data.success);
                                    this.loadFolder(this.currentPath);
                                }.bind(this),
                                function (response) {
                                    var error = (response.data.error)? response.data.error : response.statusText;
                                    systemNotification( error, 'danger' );

                                    this.$set('loading', false);
                                    this.$set('currentFile', null);
                                    this.$set('selectedFile', null);
                                }
                        );
                    }
                },

                deleteFolder: function () {
                    if (this.isFolder(this.currentFile)) {
                        this.loading = true;

                        this.$http.delete('/admin/browser/folder', {body: {'folder': this.currentPath, 'del_folder': this.currentFile}}).then(
                                function (response) {
                                    systemNotification(response.data.success);
                                    this.loadFolder(this.currentPath)
                                }.bind(this),
                                function (response) {
                                    var error = (response.data.error)? response.data.error : response.statusText;
                                    systemNotification( error, 'danger' );

                                    this.$set('loading', false);
                                    this.$set('currentFile', null);
                                    this.$set('selectedFile', null);
                                }
                        );
                    }
                },

                createFolder: function () {
                    if (this.newFolderName) {
                        this.$http.post('/admin/browser/folder', {'folder': this.currentPath, 'new_folder': this.newFolderName}).then(
                                function (response) {
                                    systemNotification(response.data.success);
                                    this.loadFolder(this.currentPath);

                                    $('#easel-new-folder').modal('hide');
                                }.bind(this),
                                function (response) {
                                    var error = (response.data.error)? response.data.error : response.statusText;
                                    systemNotification( error, 'danger' );

                                    this.$set('loading', false);
                                }
                        );

                    }

                },

                uploadFile: function (e) {
                    var files = e.target.files || e.dataTransfer.files;

                    this.fileUploadFormData.append('file', files[0]);
                    this.fileUploadFormData.append('folder', this.currentPath);

                    this.$http.post('/admin/browser/file', this.fileUploadFormData).then(
                            function (response) {
                                systemNotification(response.data.success);
                                this.loadFolder(this.currentPath)
                            }.bind(this),
                            function (response) {
                                var error = (response.data.error)? response.data.error : response.statusText;
                                systemNotification( error, 'danger' );

                                this.$set('loading', false);
                            }
                    );
                },

                renameItem: function()
                {
                    var original = ( this.isFolder(this.currentFile) )? this.currentFile : this.currentFile.name

                    this.$http.post('/admin/browser/rename', {
                        'path': this.currentPath,
                        'original': original,
                        'newName' : this.newItemName,
                        'type'    : (this.isFolder(this.currentFile))? 'Folder' : 'File'
                    }).then(
                            function (response) {
                                systemNotification(response.data.success);
                                this.loadFolder(this.currentPath);

                                $('#easel-rename-item').modal('hide');

                            }.bind(this),
                            function (response) {
                                var error = (response.data.error)? response.data.error : response.statusText;
                                systemNotification( error, 'danger' );

                                this.$set('loading', false);
                            }
                    );

                }
            }
        });

        $('#easel-file-picker').on('shown.bs.modal', function () {
            vm.loadFolder();
        });

    });
</script>

@include('easel::backend.post.partials.modals.file-picker');