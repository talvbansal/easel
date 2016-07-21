<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 21/07/16
 * Time: 12:27
 */

namespace Easel\Services\Traits;

use Illuminate\Support\Collection;

trait FindBlogLayouts
{

    /**
     * Get a collection of views that can be used as views templates for blog posts and tags
     * @return Collection
     */
    protected function getPostLayouts()
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