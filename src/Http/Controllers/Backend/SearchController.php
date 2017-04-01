<?php

namespace Easel\Http\Controllers\Backend;

use Easel\Http\Controllers\Controller;
use Easel\Models\Post;
use Easel\Models\Tag;

class SearchController extends Controller
{
    /**
     * Display search result.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $params = request('search');

        try {
            $posts = Post::search($params)->get();
            $tags = Tag::search($params)->get();
        } catch (\Exception $e) {
            //fallback to basic search
            $posts = Post::where('title', 'LIKE', '%'.$params.'%')
                ->orWhere('subtitle', 'LIKE', '%'.$params.'%')
                ->orWhere('content_raw', 'LIKE', '%'.$params.'%')
                ->orWhere('meta_description', 'LIKE', '%'.$params.'%')
                ->get();

            $tags = Tag::where('name', 'LIKE', '%'.$params.'%')
                ->get();
        }

        return view('easel::backend.search.index', compact('params', 'posts', 'tags'));
    }
}
