<?php

namespace Easel\Models;

use Carbon\Carbon;
use Easel\Services\Parsedowner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * Class Post.
 *
 * @property string title
 * @property string slug
 * @property string subtitle
 * @property string page_image
 * @property string content_raw
 * @property string content_html
 * @property string category
 * @property string meta_description
 * @property string layout
 * @property bool is_draft
 * @property int author_id
 * @property int category_id
 * @property bool featured_post
 * @property Carbon created_at
 * @property Carbon published_at
 * @property Carbon updated_at
 */
class Post extends Model
{
    use Searchable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    protected $casts = [
        'is_draft' => 'boolean',
        'featured_post' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content_raw',
        'page_image',
        'category_id',
        'meta_description',
        'layout',
        'is_draft',
        'featured_post',
        'published_at',
        'author_id',
    ];

    /**
     * Searchable items.
     *
     * @var array
     */
    public $searchable = ['title', 'subtitle', 'content_raw', 'meta_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(config('easel.user_model'), 'id', 'author_id');
    }

    /**
     * Get the tags relationship.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_pivot');
    }

    /**
     * Get the category relationship.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Set the title attribute and the slug.
     *
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if (!$this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }

    /**
     * Recursive routine to set a unique slug.
     *
     * @param string $title
     * @param mixed  $extra
     */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title.'-'.$extra);
        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);

            return;
        }
        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set.
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Parsedowner();
        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Sync tag relationships and add new tags as needed.
     *
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);
        if (count($tags)) {
            $this->tags()->sync(
                Tag::whereIn('id', $tags)->pluck('id')->all()
            );

            return;
        }
        $this->tags()->detach();
    }

    /**
     * Get the raw content attribute.
     *
     * @param $value
     *
     * @return Carbon|\Illuminate\Support\Collection|int|mixed|static
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }

    /**
     * Return URL to post.
     *
     * @param Tag $tag
     *
     * @return string
     */
    public function url(Tag $tag = null)
    {
        $url = url(config('easel.blog_base_url').'/'.$this->slug);
        if ($tag) {
            $url .= '?tag='.urlencode($tag->tag);
        }

        return $url;
    }
}
