<?php
namespace Easel\Http\Controllers\Backend;

use Session;
use Easel\Models\Tag;
use Easel\Http\Requests;
use Illuminate\Http\Request;
use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\TagUpdateRequest;
use Easel\Http\Requests\TagCreateRequest;

class TagController extends Controller
{
    const TRIM_WIDTH = 40;
    const TRIM_MARKER = "...";

    protected $fields = [
        'tag' => '',
        'title' => '',
        'subtitle' => '',
        'meta_description' => '',
        'layout' => 'frontend.blog.index',
        'reverse_direction' => 0,
        'created_at' => '',
        'updated_at' => '',
    ];

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Tag::all();

        foreach ($data as $tag) {
            $tag->subtitle = mb_strimwidth($tag->subtitle, 0, self::TRIM_WIDTH, self::TRIM_MARKER);
        }

        return view('vendor.easel.backend.tag.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [];

        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('vendor.easel.backend.tag.create', compact('data'));
    }

    /**
     * Store the newly created tag in the database
     *
     * @param TagCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagCreateRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->toArray())->save();
        $tag->save();

        Session::set('_new-tag', trans('easel::messages.create_success', ['entity' => 'tag']));
        return redirect('/admin/tag');
    }

    /**
     * Show the form for editing a tag
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $tag->$field);
        }

        return view('vendor.easel.backend.tag.edit', compact('data'));
    }

    /**
     * Update the tag in storage
     *
     * @param TagUpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->fill($request->toArray())->save();
        $tag->save();

        Session::set('_update-tag', trans('easel::messages.update_success', ['entity' => 'Tag']));
        return redirect("/admin/tag/$id/edit");
    }

    /**
     * Delete the tag
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        Session::set('_delete-tag', trans('easel::messages.delete_success', ['entity' => 'Tag']));
        return redirect('/admin/tag');
    }
}
