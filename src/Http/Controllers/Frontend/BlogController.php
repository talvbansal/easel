<?php
namespace Easel\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Easel\Http\Requests;
use Easel\Jobs\BlogIndexData;
use Easel\Models\Post;
use Easel\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag    = $request->get('tag');
        $data   = $this->dispatch(new BlogIndexData($tag));
        $layout = $tag ? Tag::layout($tag)->first() : 'vendor.easel.frontend.blog.index';

        return view($layout, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param         $slug
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showPost($slug, Request $request)
    {
        $post  = Post::with('tags')->whereSlug($slug)->firstOrFail();
        $tag   = $request->get('tag');
        $title = $post->title;
        if ($tag) {
            $tag = Tag::whereTag($tag)->firstOrFail();
        }

        return view($post->layout, compact('post', 'tag', 'slug', 'title'));
    }
}
