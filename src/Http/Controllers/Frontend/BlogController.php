<?php

namespace Easel\Http\Controllers\Frontend;

use Easel\Http\Controllers\Controller;
use Easel\Models\Post;
use Easel\Models\Tag;
use Easel\Services\PostsManager;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    /**
     * @var PostsManager
     */
    private $postsManager;

    public function __construct(PostsManager $postsManager)
    {
        $this->postsManager = $postsManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag = $request->get('tag');

        if ($tag) {
            $data = $this->postsManager->postsByTag($tag);
        } else {
            $data = $this->postsManager->allPublishedPosts();
        }


        return view('vendor.easel.frontend.blog.index', $data);
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

        $data = [
            'post'  => $post,
            'tag'   => $tag,
            'title' => $title,
        ];

        return view($post->layout, $data);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function showPostsByAuthor($id)
    {
        $data = $this->postsManager->postsByAuthorId($id);

        return view('vendor.easel.frontend.blog.index', $data);
    }
}
