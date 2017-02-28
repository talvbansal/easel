<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/08/16
 * Time: 12:23.
 */

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\UploadFileRequest;
use Easel\Http\Requests\UploadNewFolderRequest;
use Easel\Services\MediaManager;
use Illuminate\Http\Request;

/**
 * Class FileManagerController.
 */
class MediaController extends Controller
{

    /**
     * @var MediaManager
     */
    private $mediaManager;


    /**
     * FileManagerController constructor.
     *
     * @param MediaManager $mediaManager
     */
    public function __construct(MediaManager $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }


    public function index()
    {
        return view('easel::backend.media.index');
    }
}