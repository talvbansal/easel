@include('easel::backend.post.partials.modals.file-picker');

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
                pageImage: null,
                newFolderName: null,
                fileUploadFormData: new FormData(),
                newItemName: null,
                allDirectories: {},
                newFolderLocation: null
            },

            computed: {
                itemsCount: function () {
                    return this.visibleFiles.length + Object.keys(this.folders).length;
                },

                visibleFiles: function () {
                    return this.files.filter(function (item) {
                        return (item.name.substring(0, 1) != ".");
                    });
                },

                webPathToPostImage : function()
                {
                    return ( this.pageImage.length > 0 )? '/storage/'+this.pageImage : null;
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
                    this.newFolderLocation = null;
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
                        path = ( this.currentPath ) ? this.currentPath : '';
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
                    return (typeof file == 'string');
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
                        this.pageImage = file.fullPath;
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
                        var data = {'path': this.currentFile.fullPath};
                        this.delete('/admin/browser/delete', data);
                    }
                },

                deleteFolder: function () {
                    if (this.isFolder(this.currentFile)) {
                        var data = {'folder': this.currentPath, 'del_folder': this.currentFile};
                        this.delete('/admin/browser/folder', data);
                    }
                },

                createFolder: function () {
                    if (this.newFolderName) {
                        var data = {
                            'folder': this.currentPath,
                            'new_folder': this.newFolderName
                        };
                        this.post('/admin/browser/folder', data, function () {
                            $('#easel-new-folder').modal('hide');
                        });
                    }
                },

                uploadFile: function (e) {
                    var files = e.target.files || e.dataTransfer.files;
                    this.fileUploadFormData.append('file', files[0]);
                    this.fileUploadFormData.append('folder', this.currentPath);

                    this.post('/admin/browser/file', this.fileUploadFormData);
                },

                renameItem: function () {
                    var original = ( this.isFolder(this.currentFile) ) ? this.currentFile : this.currentFile.name;

                    var data = {
                        'path': this.currentPath,
                        'original': original,
                        'newName': this.newItemName,
                        'type': (this.isFolder(this.currentFile)) ? 'Folder' : 'File'
                    };

                    this.post('/admin/browser/rename', data, function () {
                        $('#easel-rename-item').modal('hide');
                    });
                },

                {{-- Don't use the bootstrap html attributes to open the modal since we need to populate the folders based on an up to date listing--}}
                openMoveModal: function () {

                    this.$http.get('/admin/browser/directories').then(
                            function (response) {
                                $('#easel-move-item').modal('show');
                                this.newFolderLocation = this.currentPath;
                                this.allDirectories = response.data;
                            }.bind(this),
                            function (response) {
                                var error = (response.data.error) ? response.data.error : response.statusText;
                                systemNotification(error, 'danger');
                            }
                    );

                },

                moveItem: function () {
                    var currentItem = ( this.isFolder(this.currentFile) ) ? this.currentFile : this.currentFile.name

                    var data = {
                        'path': this.currentPath,
                        'currentItem': currentItem,
                        'newPath': this.newFolderLocation,
                        'type': (this.isFolder(this.currentFile)) ? 'Folder' : 'File'
                    };

                    this.post('/admin/browser/move', data, function () {
                        $('#easel-move-item').modal('hide');
                    });
                },

                delete: function (route, payload, callback) {
                    this.loading = true;
                    this.$http.delete(route, {body: payload}).then(
                            function (response) {
                                if (response.data.success) systemNotification(response.data.success);
                                this.loadFolder(this.currentPath);
                                if (typeof callback == 'function') callback();
                            }.bind(this),
                            function (response) {
                                var error = (response.data.error) ? response.data.error : response.statusText;
                                systemNotification(error, 'danger');

                                this.$set('loading', false);
                                this.$set('currentFile', null);
                                this.$set('selectedFile', null);
                            }
                    );
                },

                post: function (route, payload, callback) {
                    this.loading = true;
                    this.$http.post(route, payload).then(
                            function (response) {
                                if (response.data.success) systemNotification(response.data.success);
                                this.loadFolder(this.currentPath);
                                if (typeof callback == 'function') callback();

                            }.bind(this),
                            function (response) {
                                var error = (response.data.error) ? response.data.error : response.statusText;
                                systemNotification(error, 'danger');

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
