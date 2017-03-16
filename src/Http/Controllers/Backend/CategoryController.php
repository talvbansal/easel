<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 15/03/17
 * Time: 18:17.
 */

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();

        return view('easel::backend.category.index', compact('data'));
    }
}
