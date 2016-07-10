<div class="clearfix modal-preview-demo">
    <div class="modal fade" id="modal-file-upload">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload a File</h4>
                </div>
                <form method="POST" action="/admin/upload/file" class="form-horizontal" enctype="multipart/form-data" id="fileCreate">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="folder" value="{{ $folder }}">

                        <p class="f-500 c-black m-b-20">Preview</p>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                            <div>
                                <span class="btn btn-primary btn-file">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="name" name="file">
                                </span>
                                <a href="#" class="btn btn-link fileinput-exists"
                                   data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>

                        <div class="clearfix"><br></div>
                        <div class="fg-line">
                            <input type="text" id="file_name" name="file_name" class="form-control" placeholder="Filename (Optional)">
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