<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 15/03/17
 * Time: 18:17.
 */

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\CategoryCreateRequest;
use Easel\Models\Category;
use Easel\Services\CategoryManager;
use Session;

class CategoryController extends Controller
{
    /**
     * @var CategoryManager
     */
    private $categoryManager;

    public function __construct( CategoryManager $categoryManager )
    {
        $this->categoryManager = $categoryManager;
    }

    public function index()
    {
        $data = Category::all();

        return view('easel::backend.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->categoryManager->getViewData();

        return view('easel::backend.category.create', compact('data'));
    }

    /**
     * Store the newly created category in the database.
     *
     * @param CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        $this->categoryManager->create($request->except(['_token']));

        Session::put('_new-category', trans('easel::messages.create_success', ['entity' => 'Category']));

        return redirect('/admin/category');
    }
}
