<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 02/08/16
 * Time: 10:11.
 */
namespace Easel\Services;

use Carbon\Carbon;
use Easel\Models\Post;
use Easel\Models\Tag;
use Illuminate\Pagination\Paginator;

/**
 * Class PostsManager.
 */
class PostsManager
{
    /**
     * @return array
     */
    public function allPublishedPosts()
    {
        $posts = Post::with('tags')
                     ->where('published_at', '<=', Carbon::now())
                     ->where('is_draft', 0)
                     ->orderBy('published_at', 'desc')
                     ->simplePaginate(config('easel.posts_per_page'));

        return $this->assemblePostData($posts);
    }

    /**
     * @param $author_id
     *
     * @return array
     */
    public function postsByAuthorId($author_id)
    {
        $posts = Post::with('tags')
                     ->where('author_id', '=', $author_id)
                     ->where('published_at', '<=', Carbon::now())
                     ->where('is_draft', 0)
                     ->orderBy('published_at', 'desc')
                     ->simplePaginate(config('easel.posts_per_page'));

        return $this->assemblePostData($posts);
    }

    /**
     * @param Paginator $posts
     * @param null      $tag
     *
     * @return array
     */
    private function assemblePostData(Paginator $posts, Tag $tag = null)
    {
        return [
            'title'             => config('easel.title'),
            'subtitle'          => config('easel.subtitle'),
            'posts'             => $posts,
            'page_image'        => config('easel.page_image'),
            'meta_description'  => config('easel.description'),
            'reverse_direction' => ($tag !== null && $tag->reverse_direction) ? $tag->reverse_direction : false,
            'tag'               => $tag,
        ];
    }

    /**
     * @param $tag
     *
     * @return array
     */
    public function postsByTag($tag)
    {
        $tag = Tag::where('tag', $tag)->firstOrFail();
        $reverse_direction = (bool) $tag->reverse_direction;
        $posts = Post::where('published_at', '<=', Carbon::now())
                     ->whereHas('tags', function ($q) use ($tag) {
                         $q->where('tag', '=', $tag->tag);
                     })
                     ->where('is_draft', 0)
                     ->orderBy('published_at', $reverse_direction ? 'asc' : 'desc')
                     ->simplePaginate(config('easel.posts_per_page'));
        $posts->addQuery('tag', $tag->tag);

        return $this->assemblePostData($posts, $tag);
    }
}
