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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
        return $this->posts->count();
    }
}
