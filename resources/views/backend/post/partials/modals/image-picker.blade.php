<div class="modal fade" id="image-picker" tabIndex="-1" role="dialog">
    <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Image Selector</h4>
            </div>

            <div class="modal-body">

                <div id="fileBrowser">

                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li v-if="breadCrumbs.length == 0">
                                <a href="#">Root</a>
                            </li>

                            <li v-for="(path, name) in breadCrumbs">
                                <a href="#" @click=loadFolder(path)>@{{ name }}</a>
                            </li>
                        </ol>
                    </div>


                    <div class="row">
                        <div class="col-md-9">

                            <h4>Files and folders</h4>

                            <ul class="list-group">
                                <li v-for="folder in folders" class="list-group-item">
                                    <i class="zmdi zmdi-folder-outline"></i>
                                    <a href="#" @click="loadFolder(folder)">@{{ folder }}</a>
                                </li>

                                <li v-for="file in files" class="list-group-item">
                                    <span v-if="isImage(file)">
                                        <i class="zmdi zmdi-image"></i>
                                        <a href="#" @click="previewImage(file)" @dblclick="selectImage(file)">@{{ file.name }}</a>
                                    </span>

                                    <span v-else>
                                        <i class="zmdi zmdi-file-text"></i>
                                        <a href="@{{ file.webPath }}" target="_blank">@{{ file.name }}</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3" v-show="currentFile">

                            <h4>Preview</h4>
                            <a href="@{{ currentFile.webPath }}" target="_blank" >
                                <img id="easel-preview-image" class="img-responsive thumbnail" />
                                <p class="text-center">
                                    <strong>@{{ currentFile.name }}</strong>
                                </p>
                            </a>

                        </div>
                    </div>

                    <?php
                    echo '<pre>{{ $data | json }}</pre>';
                    //*/ ?>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        var vm = new Vue({
            el: '#fileBrowser',
            data: {
                currentFile: null,
                folders: {},
                files: {},
                breadCrumbs : {}
            },

            methods: {

                loadFolder: function (path) {
                    if (!path) path = '';

                    this.$http.get('/admin/browser/index?path=' + path).then(
                            function (response) {
                                this.$set('folders', response.data.subfolders);
                                this.$set('files', response.data.files);
                                this.$set('breadCrumbs', response.data.breadcrumbs);
                            },
                            function (error) {

                            }
                    );
                },

                isImage: function (file) {
                    return file.mimeType.indexOf('image') != -1;

                },

                previewImage: function (file) {
                    this.currentFile = file;
                    $('#easel-preview-image').attr('src', this.currentFile.webPath);
                },

                selectImage: function (file) {
                    console.log(file)
                }

            }
        });


        $('#image-picker').on('shown.bs.modal', function () {
            vm.loadFolder();
        });

    });

</script>