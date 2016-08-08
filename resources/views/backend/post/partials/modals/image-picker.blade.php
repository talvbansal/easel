<div class="modal fade" id="image-picker" tabIndex="-1" role="dialog">
    <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Image Selector</h4>
            </div>

            <div class="modal-body">

                <div id="easel-file-browser">

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

                        <div class="col-sm-9 col-md-9 col-lg-10">

                            <div class="table-responsive">
                                <table class="table table-condensed table-vmiddle">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="folder in folders">
                                        <td>
                                            <i class="zmdi zmdi-folder-outline"></i>
                                            <a href="#" @click="loadFolder(folder)" class="word-wrappable">@{{ folder }}</a>
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>

                                    <tr v-for="file in files">
                                        <td>
                                            <span v-if="isImage(file)">
                                                <i class="zmdi zmdi-image"></i>
                                                <a href="#" @click="previewImage(file)" @dblclick="selectImage(file)" class="word-wrappable">@{{ file.name }}</a>
                                            </span>

                                            <span v-else>
                                                <i class="zmdi zmdi-file-text"></i>
                                                <a href="@{{ file.webPath }}" target="_blank" class="word-wrappable">@{{ file.name }}</a>
                                            </span>
                                        </td>
                                        <td> @{{ file.mimeType }} </td>
                                        <td> @{{ humanFileSize(file.size) }} </td>
                                        <td> @{{ file.modified.date | moment 'L LTS' }}</td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>


                        <div class="col-sm-3 col-md-3 col-lg-2" v-show="currentFile">

                            <h4>Preview</h4>
                            <a href="@{{ currentFile.webPath }}" target="_blank">
                                <img id="easel-preview-image" class="img-responsive thumbnail" :src="currentFile.webPath"/>
                                <p class="text-center">
                                    <strong style="word-wrap: break-word">@{{ currentFile.name }}</strong>
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
            el: '#easel-file-browser',
            data: {
                currentFile: null,
                folders: {},
                files: {},
                breadCrumbs: {}
            },

            methods: {

                loadFolder: function (path) {
                    if (!path) path = '';

                    //we need loaders

                    this.$http.get('/admin/browser/index?path=' + path).then(
                            function (response) {

                                //remove loader

                                this.$set('folders', response.data.subfolders);
                                this.$set('files', response.data.files);
                                this.$set('breadCrumbs', response.data.breadcrumbs);
                                this.currentFile = null;
                            },
                            function (error) {
                                this.currentFile = null;
                                //remove loader and display error
                            }
                    );
                },

                isImage: function (file) {
                    return file.mimeType.indexOf('image') != -1;

                },

                previewImage: function (file) {
                    this.currentFile = file;
                },

                selectImage: function (file) {
                    console.log(file)
                },

                humanFileSize: function (size) {
                    var i = Math.floor(Math.log(size) / Math.log(1024));
                    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
                }

            }
        });


        $('#image-picker').on('shown.bs.modal', function () {
            vm.loadFolder();
        });

    });

</script>