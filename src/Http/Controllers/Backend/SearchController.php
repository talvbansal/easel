<?php

namespace Easel\Http\Controllers\Backend;

use Easel\Models\Tag;
use Easel\Models\Post;
use Easel\Http\Requests;
use Illuminate\Http\Request;use Easel\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display search result.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $params = \Request::get('search');
        $posts = \Post::where('title', 'LIKE', '%'.$params.'%')->get();
        $tags = \Tag::where('title', 'LIKE', '%'.$params.'%')->get();

        return view('easel::backend.search.index', compact('params', 'posts', 'tags'));
    }
}
