<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/08/16
 * Time: 12:23
 */

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\UploadFileRequest;
use Easel\Http\Requests\UploadNewFolderRequest;
use Easel\Services\UploadsManager;
use Illuminate\Http\Request;

/**
 * Class FileManagerController
 * @package Easel\Http\Controllers\Backend
 */
class FileManagerController extends Controller
{

    /**
     * @var UploadsManager
     */
    private $uploadsManager;


    /**
     * FileManagerController constructor.
     *
     * @param UploadsManager $uploadsManager
     */
    public function __construct(UploadsManager $uploadsManager)
    {
        $this->uploadsManager = $uploadsManager;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $path = request('path');

        return $this->uploadsManager->folderInfo($path);
    }


    /**
     * @param UploadNewFolderRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder     = $request->get('folder') . '/' . $new_folder;

        try {
            $result = $this->uploadsManager->createDirectory($folder);

            if ($result !== true) {
                $error = $result ?: trans('easel::messages.create_error', [ 'entity' => 'directory' ]);

                return $this->errorResponse($error);
            }

            return [ 'success' => trans('easel::messages.create_success', [ 'entity' => 'folder' ]) ];

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * Delete a folder.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder     = $request->get('folder') . '/' . $del_folder;

        try {
            $result = $this->uploadsManager->deleteDirectory($folder);
            if ($result !== true) {
                $error = $result ?: trans('easel::messages.delete_error', [ 'entity' => 'folder' ]);

                return $this->errorResponse($error);
            }

            return [ 'success' => trans('easel::messages.delete_success', [ 'entity' => 'folder' ]) ];

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile()
    {
        $path = request('path');
        try {
            $result = $this->uploadsManager->deleteFile($path);

            if ($result !== true) {
                $error = $result ?: trans('easel::messages.delete_error', [ 'entity' => 'File' ]);

                return $this->errorResponse($error);
            }

            return [ 'success' => trans('easel::messages.delete_success', [ 'entity' => 'File' ]) ];

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }


    /**
     * Upload new file.
     *
     * @param UploadFileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(UploadFileRequest $request)
    {
        try {
            $file     = $_FILES['file'];
            $fileName = $request->get('file_name');
            $fileName = $fileName ?: $file['name'];
            $path     = str_finish($request->get('folder'), '/') . $fileName;
            $content  = \File::get($file['tmp_name']);
            $result   = $this->uploadsManager->saveFile($path, $content);

            if ($result !== true) {
                $error = $result ?: trans('easel::messages.upload_error', [ 'entity' => 'File' ]);

                return $this->errorResponse($error);
            }

            return [ 'success' => trans('easel::messages.upload_success', [ 'entity' => 'File' ]) ];


        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * @param Request $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function rename(Request $request)
    {
        $path     = $request->get('path');
        $original = $request->get('original');
        $newName  = $request->get('newName');
        $type  = $request->get('type');

        try {
            $result = $this->uploadsManager->rename($path, $original, $newName);

            if ($result !== true) {
                $error = $result ?: trans('easel::messages.rename_error', [ 'entity' => $type ]);

                return $this->errorResponse($error);
            }

            return [ 'success' => trans('easel::messages.rename_success', [ 'entity' => $type ]) ];

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * @param     $error
     * @param int $errorCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse($error, $errorCode = 400)
    {
        return \Response::json([ 'error' => $error ], $errorCode);
    }

}