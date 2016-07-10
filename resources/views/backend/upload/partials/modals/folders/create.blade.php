<div class="clearfix modal-preview-demo">
    <div class="modal fade" id="modal-folder-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create a new folder</h4>
                </div>
                <form method="POST" action="/admin/upload/folder" class="form-horizontal" id="folderCreate">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="folder" value="{{ $folder }}">
                        <div class="form-group" style="padding: 0 18px 0 18px">
                            <div class="fg-line">
                                <input type="text" id="new_folder_name" name="new_folder" class="form-control simplebox" placeholder="Folder Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link btn-icon-text"><i class="zmdi zmdi-floppy"></i> Save</button>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>