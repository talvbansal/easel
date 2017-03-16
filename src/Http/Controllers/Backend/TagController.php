<?php

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\TagCreateRequest;
use Easel\Http\Requests\TagUpdateRequest;
use Easel\Models\Tag;
use Easel\Services\TagManager;
use Session;

class TagController extends Controller
{
    protected $fields = [
        'tag'               => '',
        'title'             => '',
        'subtitle'          => '',
        'meta_description'  => '',
        'layout'            => 'vendor.frontend.blog.index',
        'reverse_direction' => 0,
        'created_at'        => '',
        'updated_at'        => '',
    ];
    /**
     * @var TagManager
     */
    private $tagManager;

    public function __construct(TagManager $tagManager)
    {
        $this->tagManager = $tagManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Tag::all();

        return view('easel::backend.tag.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->tagManager->getViewData();

        return view('easel::backend.tag.create', compact('data'));
    }

    /**
     * Store the newly created tag in the database.
     *
     * @param TagCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagCreateRequest $request)
    {
        $this->tagManager->create($request->except(['_token']));

        Session::put('_new-tag', trans('easel::messages.create_success', ['entity' => 'Tag']));

        return redirect('/admin/tag');
    }

    /**
     * Show the form for editing a tag.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->tagManager->getViewData($id);

        return view('easel::backend.tag.edit', compact('data'));
    }

    /**
     * Update the tag in storage.
     *
     * @param TagUpdateRequest $request
     * @param int              $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $this->tagManager->edit($id, $request->toArray());

        Session::put('_update-tag', trans('easel::messages.update_success', ['entity' => 'Tag']));

        return redirect("/admin/tag/$id/edit");
    }

    /**
     * Delete the tag.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->tagManager->delete($id);

        Session::put('_delete-tag', trans('easel::messages.delete_success', ['entity' => 'Tag']));

        return redirect('/admin/tag');
    }
}
