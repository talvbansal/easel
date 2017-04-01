<?php

namespace Easel\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Tag.
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Tag extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Searchable items.
     *
     * @var array
     */
    public $searchable = ['name', 'slug'];

    /**
     * Get the posts relationship.
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag_pivot');
    }

    /**
     * Add tags from the list.
     *
     * @param array $tags List of tags to check/add
     */
    public static function addNeededTags(array $tags)
    {
        if (count($tags) === 0) {
            return;
        }
        $found = self::whereIn('tag', $tags)->pluck('tag')->all();
        foreach (array_diff($tags, $found) as $tag) {
            static::create([
                'name' => $tag,
                'slug' => $tag,
            ]);
        }
    }
}
