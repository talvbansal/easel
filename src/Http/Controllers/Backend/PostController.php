<?php
namespace Easel\Http\Controllers\Backend;

use Session;
use App\Http\Controllers\Controller;
use Easel\Models\Post;
use Easel\Jobs\PostFormFields;
use Easel\Http\Requests\PostCreateRequest;
use Easel\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    const TRIM_WIDTH = 40;
    const TRIM_MARKER = "...";

    /**
     * Display a listing of the posts
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Post::all();

        foreach ($data as $post) {
            $post->subtitle = mb_strimwidth($post->subtitle, 0, self::TRIM_WIDTH, self::TRIM_MARKER);
        }

        return view('vendor.easel.backend.post.index', compact('data'));
    }

    /**
     * Show the new post form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->dispatch(new PostFormFields());
        return view('vendor.easel.backend.post.create', $data);
    }

    /**
     * Store a newly created Post
     *
     * @param PostCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $post->syncTags($request->get('tags', []));

        Session::set('_new-post', trans('easel::messages.create_success', ['entity' => 'post']));
        return redirect()->route('admin.post.index');
    }

    /**
     * Show the post edit form
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->dispatch(new PostFormFields($id));
        return view('vendor.easel.backend.post.edit', $data);
    }

    /**
     * Update the Post
     *
     * @param PostUpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));

        Session::set('_update-post', trans('easel::messages.update_success', ['entity' => 'Post']));
        return redirect("/admin/post/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        Session::set('_delete-post', trans('easel::messages.delete_success', ['entity' => 'Post']));
        return redirect()->route('admin.post.index');
    }
}
