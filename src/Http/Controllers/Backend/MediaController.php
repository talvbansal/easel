<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/08/16
 * Time: 12:23.
 */

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Services\MediaManager;

/**
 * Class FileManagerController.
 */
class MediaController extends Controller
{
    public function index()
    {
        return view('easel::backend.media.index');
    }
}
