<?php
namespace Easel\Http\Jobs;

use Carbon\Carbon;
use Easel\Models\Post;
use Easel\Models\Tag;
use Illuminate\Support\Collection;

class PostFormFields extends Job
{
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


    /**
     * Get a collection of views that can be used as templates for blog posts
     * @return Collection
     */
    private function getPostLayouts()
    {
        $defaultLayout = config('easel.layouts.default');
        $layoutsFolder = config('easel.layouts.posts');

        $layoutsFullPath = resource_path(str_replace('.', DIRECTORY_SEPARATOR, '/views/' . $layoutsFolder)) ;

        // If the given path for additional layouts doesn't exist just return the default layout
        if ( ! is_dir($layoutsFullPath)) {
            return collect([ $defaultLayout => 'default' ]);
        }

        // Collect views from the layouts directory then filter them to only show .blade.php files
        $files = scandir($layoutsFullPath);

        $files = ( new Collection($files) )->filter(function ($file) use ($layoutsFullPath) {

            return is_file($layoutsFullPath . '/' . $file) && ends_with($file, '.blade.php');

        })->reduce(function ($files, $file) use ($layoutsFolder) {
            $fileName       = explode('.', $file)[0];
            $fullLayoutName = $layoutsFolder . '.' . $fileName;

            return [ $fullLayoutName => $fileName ];
        });

        //add the default view
        return collect( $files )->prepend( 'default', $defaultLayout );
    }


}