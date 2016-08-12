<div class="modal fade" id="easel-file-picker" tabIndex="-1" role="dialog">
    <div class="modal-dialog easel-adaptive-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>

                <div class="btn-toolbar" role="toolbar" role="toolbar">
                    <div class="btn-group offset-right">

                        {{-- File input wont get triggered if this is a button so use a label instead --}}
                        <label class="btn btn-primary btn-icon-text waves-effect btn-file" title="Upload">
                            <i class="zmdi zmdi-upload" ></i>
                            <span class="hidden-xs">Upload</span>
                            <input type="file" class="hidden" @change="uploadFile" name="files[]" />
                        </label>

                        <button data-toggle="modal" href="#easel-new-folder" class="btn btn-primary btn-icon-text waves-effect" type="button" title="Add Folder">
                            <i class="zmdi zmdi-folder"></i>
                            <span class="hidden-xs">Add folder</span>
                        </button>

                    </div>

                    <div class="btn-group offset-right">
                        <button class="btn btn-default btn-icon-text waves-effect" type="button" @click="loadFolder(currentPath)" title="Refresh">
                        <i class="zmdi zmdi-refresh"></i>
                        <span class="hidden-xs">Refresh</span>
                        </button>
                    </div>

                    <div class="btn-group offset-right">
                        {{--<button class="btn btn-default btn-icon-text waves-effect" type="button" :disabled="!currentFile" title="Move">
                            <i class="zmdi zmdi-forward"></i>
                            <span class="hidden-xs">Move</span>
                        </button>--}}

                        <button class="btn btn-default btn-icon-text waves-effect" type="button" :disabled="!currentFile" @click="deleteItem()" title="Delete">
                        <i class="zmdi zmdi-delete"></i>
                        <span class="hidden-xs">Delete</span>
                        </button>


                        <button data-toggle="modal" href="#easel-rename-item" class="btn btn-default btn-icon-text waves-effect" type="button" :disabled="!currentFile" title="Rename">
                            <i class="zmdi zmdi-border-color"></i>
                            <span class="hidden-xs">Rename</span>
                        </button>
                    </div>

                </div>
            </div>

            <div class="modal-body" id="easel-file-browser">

                <div class="row">
                    <div class="col-xs-12">
                        <ol class="breadcrumb">

                            <li v-for="(path, name) in breadCrumbs">
                                <a href="javascript:void(0);" @click=loadFolder(path)>@{{ name }}</a>
                            </li>

                            <li class="active">
                                @{{ folderName }}
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">


                    <div :class="{ 'col-md-12' : !currentFile || isFolder(currentFile), 'col-sm-9' : currentFile }" class="col-xs-12">
                        {{-- Loader --}}
                        <div v-if="loading" transition="fade">
                            <div class="preloader pl-xxl" style="position: relative; left: 50%; margin-left: -25px; top: 50%;">
                                <svg viewBox="25 25 50 50" class="pl-circular">
                                    <circle r="20" cy="50" cx="50" class="plc-path"/>
                                </svg>
                            </div>
                        </div>

                        {{-- File List --}}
                        <div v-else class="table-responsive easel-file-picker-list" transition="fade">
                            <table class="table table-condensed table-vmiddle">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="(path, folder) in folders" :class="[ (folder == currentFile) ? 'active' : '' ]">
                                    <td>
                                        <i class="zmdi zmdi-folder-outline"></i> &nbsp;
                                        <a href="javascript:void(0);" @click="previewFile(folder)" @dblclick="loadFolder(path)" class="
                                        word-wrappable" >@{{ folder }}</a>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>

                                <tr v-for="file in visibleFiles" :class="[ (file == currentFile) ? 'active' : '' ]">
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

                    {{-- Sidebar --}}
                    <div v-show="currentFile && !isFolder(currentFile)" class="easel-file-picker-sidebar hidden-xs col-sm-3">

                        <img v-show="isImage(currentFile)" id="easel-preview-image" class="img-responsive center-block" :src="currentFile.webPath" style="max-height: 200px"/>

                        <table class="table-responsive table-condensed table-vmiddle easel-file-picker-preview-table">
                            <tbody>
                            <tr>
                                <td class="description">Name</td>
                                <td class="file-value">@{{ currentFile.name }}</td>
                            </tr>
                            <tr>
                                <td class="description">Size</td>
                                <td class="file-value">@{{ currentFile.size | humanFileSize }}</td>
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

            <div class="modal-footer vertical-center">

                <div class="item-count">
                    @{{ itemsCount }} Items
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-primary" v-show="currentFile" @click="selectFile(currentFile)">Select File</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>


            @if (config('app.debug') )
                <br>
                <pre>@{{ $data | json }}</pre>
            @endif

        </div>
    </div>
</div>

@include('easel::backend.post.partials.modals.create-folder')
@include('easel::backend.post.partials.modals.rename-item')