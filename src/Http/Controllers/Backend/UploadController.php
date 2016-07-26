<?php

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\UploadFileRequest;
use Easel\Http\Requests\UploadNewFolderRequest;
use Easel\Services\UploadsManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class UploadController extends Controller
{
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Show page of files / subfolders.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('vendor.easel.backend.upload.index', $data);
    }

    /**
     * Create a new folder.
     *
     * @param UploadNewFolderRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder').'/'.$new_folder;
        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            Session::set('_new-folder', trans('easel::messages.create_success', ['entity' => 'folder']));

            return redirect()->back();
        } else {
            $error = $result ?: trans('easel::messages.create_error', ['entity' => 'directory']);

            return redirect()->back()->withErrors([$error]);
        }
    }

    /**
     * Delete a folder.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder').'/'.$del_folder;
        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {
            Session::set('_delete-folder', trans('easel::messages.delete_success', ['entity' => 'Folder']));

            return redirect()->back();
        } else {
            $error = $result ?: trans('messages.delete_error', ['entity' => 'directory']);

            return redirect()->back()->withErrors([$error]);
        }
    }

    /**
     * Upload new file.
     *
     * @param UploadFileRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ?: $file['name'];
        $path = str_finish($request->get('folder'), '/').$fileName;
        $content = File::get($file['tmp_name']);
        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            Session::set('_new-file', trans('easel::messages.upload_success', ['entity' => 'file']));

            return redirect()->back();
        } else {
            $error = $result ?: trans('easel::messages.upload_error', ['entity' => 'file']);

            return redirect()->back()->withErrors([$error]);
        }
    }

    /**
     * Delete a file.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder').'/'.$del_file;
        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            Session::set('_delete-file', trans('easel::messages.delete_success', ['entity' => 'File']));

            return redirect()->back();
        } else {
            $error = $result ?: trans('easel::messages.delete_error', ['entity' => 'file']);

            return redirect()->back()->withErrors([$error]);
        }
    }
}
