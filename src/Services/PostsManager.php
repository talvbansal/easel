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
    public function publishedPosts()
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
            'reverse_direction' => false,
            'tag'               => $tag,
        ];
    }
}
