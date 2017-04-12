<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/03/17
 * Time: 11:49.
 */

namespace Easel\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * Class Category.
 *
 * @property string name
 * @property string slug
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Category extends Model
{

    use Searchable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    public $searchable = [
        'name',
        'slug'
    ];

    /**
     * Get the post relationship.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postCount()
    {
        return $this->posts->where('published_at', '<=', Carbon::now())
                           ->where('is_draft', 0)
                           ->count();
    }
}
