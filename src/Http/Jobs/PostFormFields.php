<?php
namespace Easel\Http\Jobs;

use Carbon\Carbon;
use Easel\Models\Post;
use Easel\Models\Tag;
use Easel\Services\Traits\FindBlogLayouts;

class PostFormFields extends Job
{
    use FindBlogLayouts;

    /**
     * The id (if any) of the Post row
     *
     * @var integer
     */
    protected $id;
    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    protected $fieldList = [
        'title'            => '',
        'subtitle'         => '',
        'page_image'       => '',
        'content'          => '',
        'meta_description' => '',
        'is_draft'         => "0",
        'publish_date'     => '',
        'publish_time'     => '',
        'published_at'     => '',
        'updated_at'       => '',
        'layout'           => '',
        'tags'             => [ ],
    ];

    /**
     * Create a new command instance.
     *
     * @param integer $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the command.
     *
     * @return array of field names => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        if ($this->id) {
            $fields = $this->fieldsFromModel($this->id, $fields);
        } else {
            $when                   = Carbon::now()->addHour();
            $fields['published_at'] = $when;
            $fields['publish_date'] = $when->format('M-j-Y');
            $fields['publish_time'] = $when->format('g:i A');
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[ $fieldName ] = old($fieldName, $fieldValue);
        }

        return array_merge(
            $fields,
            [
                'allTags' => Tag::lists('tag')->all(),
                'layouts' => $this->getPostLayouts()
            ]
        );
    }

    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array   $fields
     *
     * @return array
     */
    protected function fieldsFromModel($id, array $fields)
    {
        $post       = Post::findOrFail($id);
        $fieldNames = array_keys(array_except($fields, [ 'tags' ]));
        $fields     = [ 'id' => $id ];
        foreach ($fieldNames as $field) {
            $fields[ $field ] = $post->{$field};
        }
        $fields['tags'] = $post->tags()->lists('tag')->all();

        return $fields;
    }


}