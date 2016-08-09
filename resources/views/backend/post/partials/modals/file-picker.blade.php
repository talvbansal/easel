<div class="modal fade" id="easel-file-picker" tabIndex="-1" role="dialog">
    <div class="modal-dialog easel-adaptive-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">File Picker</h4>
            </div>

            <div class="modal-body">

                <div id="easel-file-browser">

                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li v-for="(path, name) in breadCrumbs">
                                <a href="javascript:void(0);" @click=loadFolder(path)>@{{ name }}</a>
                            </li>

                            <li>
                                <a href="javascript:void(0);">@{{ folderName }}</a>
                            </li>
                        </ol>
                    </div>

                    <div class="row">

                        {{-- Loader --}}
                        <div :class="{ 'col-md-12' : !currentFile, 'col-sm-9' : currentFile }" class="col-xs-12">
                            <div v-if="loading">
                                <div class="preloader pl-xxl" style="position: relative; left: 50%; margin-left: -25px; top: 50%;">
                                    <svg viewBox="25 25 50 50" class="pl-circular">
                                        <circle r="20" cy="50" cx="50" class="plc-path"/>
                                    </svg>
                                </div>
                            </div>

                            <div v-else class="table-responsive easel-file-picker-list">
                                <table class="table table-condensed table-vmiddle">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(path, folder) in folders">
                                        <td>
                                            <i class="zmdi zmdi-folder-outline"></i>
                                            <a href="javascript:void(0);" @click="loadFolder(path)" class="word-wrappable" >@{{ folder }}</a>
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>

                                    <tr v-for="file in files" :class="[ (file == currentFile) ? 'active' : '' ]">
                                        <td>
                                            <i v-if="isImage(file)" class="zmdi zmdi-image"></i>
                                            <i v-else class="zmdi zmdi-file-text"></i>
                                            <a href="javascript:void(0);" @click="previewFile(file)" @dblclick="selectFile(file)" class="
                                            word-wrappable">@{{ file.name }}</a>

                                        </td>
                                        <td> @{{ file.mimeType }} </td>
                                        <td> @{{ file.modified.date | moment 'L' }}</td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>


                        <div v-show="currentFile" class="easel-file-picker-sidebar hidden-xs  col-sm-3">

                            <img v-show="isImage(currentFile)" id="easel-preview-image" class="img-responsive center-block" :src="currentFile.webPath" style="max-height: 200px"/>

                            <table class="table-responsive table-condensed table-vmiddle easel-file-picker-preview-table">
                                <tbody>
                                <tr>
                                    <td class="description">Name</td>
                                    <td class="file-value">@{{ currentFile.name }}</td>
                                </tr>
                                <tr>
                                    <td class="description">Size</td>
                                    <td class="file-value">@{{ humanFileSize(currentFile.size) }}</td>
                                </tr>
                                <tr>
                                    <td class="description">Public URL</td>
                                    <td class="file-value"><a :href="currentFile.webPath" target="_blank">Click Here</a></td>
                                </tr>
                                <tr>
                                    <td class="description">Date</td>
                                    <td class="file-value">@{{ currentFile.modified.date | moment 'L LT' }}</td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-show="currentFile" @click="selectFile(currentFile)">Select File</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>



            @if (config('app.debug') )
                <br>
                <pre>@{{ $data | json }}</pre>
            @endif

        </div>
    </div>
</div>
