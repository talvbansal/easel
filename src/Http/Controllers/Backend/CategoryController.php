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
use Easel\Http\Requests\CategoryUpdateRequest;
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

    /**
     * Show the form for editing a category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->categoryManager->getViewData($id);

        return view('easel::backend.category.edit', compact('data'));
    }

    /**
     * Update the category in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param int              $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->categoryManager->edit($id, $request->toArray());

        Session::put('_update-category', trans('easel::messages.update_success', ['entity' => 'Category']));

        return redirect("/admin/category/$id/edit");
    }

    /**
     * Delete the category.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryManager->delete($id);

        Session::put('_delete-category', trans('easel::messages.delete_success', ['entity' => 'Category']));

        return redirect('/admin/category');
    }
}
