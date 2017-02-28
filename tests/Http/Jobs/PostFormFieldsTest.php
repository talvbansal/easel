<?php

namespace EaselTest\Http\Jobs;

use Easel\Http\Jobs\PostFormFields;
use EaselTest\TestCase;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 20/07/16
 * Time: 17:22.
 */
class PostFormFieldsTest extends TestCase
{
    /**
     * @var \Illuminate\Support\Collection
     */
    private $filesCreated;

    public function setUp()
    {
        parent::setUp();

        $this->filesCreated = collect();
    }

    public function tearDown()
    {
        $this->filesCreated->each(function ($file) {
            try {
                unlink($file);
            } catch (Exception $e) {
            }
        });

        parent::tearDown();
    }

    /**
     * Allow the private getPostLayouts method to become accessible / invokable.
     *
     * @return ReflectionMethod
     */
    private function getPostLayoutsAsPublic()
    {
        $reflection = new ReflectionClass(PostFormFields::class);
        $getPostLayouts = $reflection->getMethod('getPostLayouts');
        $getPostLayouts->setAccessible(true);

        return $getPostLayouts;
    }

    /**
     * @param $fileName
     *
     * @return bool
     */
    private function createNewBlogTemplateFile($fileName)
    {
        $path = $this->createPathFromFileName($fileName);

        return $this->createFile($path);
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    private function createPathFromFileName($fileName)
    {
        $path = resource_path(str_replace('.', DIRECTORY_SEPARATOR, '/views/'.config('easel.layouts.posts.custom'))).'/'.$fileName;

        return $path;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    private function createFile($path)
    {
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        if (touch($path)) {
            $this->filesCreated->push($path);

            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getLayouts()
    {
        $getPostLayouts = $this->getPostLayoutsAsPublic();

        $postFormFields = new PostFormFields();
        /** @var \Illuminate\Support\Collection $response */
        $response = $getPostLayouts->invoke($postFormFields);

        return $response;
    }

    public function test_default_layout_only()
    {
        $response = $this->getLayouts();

        // Is there only one layout returned
        $this->assertCount(1, $response);
        // Is the stored key in the collection
        $this->assertTrue($response->contains('default'));
        // Is the displayed value in the collection
        $this->assertTrue($response->has('vendor.easel.frontend.blog.post'));
    }

    public function test_additional_layout()
    {
        $this->createNewBlogTemplateFile('gallery.blade.php');
        $response = $this->getLayouts();

        // Are there 2 values layout returned, default + new layout
        $this->assertCount(2, $response);
        // Are these keys in the collection
        $this->assertTrue($response->contains('default'));
        $this->assertTrue($response->contains('gallery'));
        // Are these values in the collection
        $this->assertTrue($response->has('vendor.easel.frontend.blog.post'));
        $this->assertTrue($response->has(config('easel.layouts.posts.custom').'.gallery'));
    }

    public function test_only_blade_php_files_are_considered_layouts()
    {
        $this->createNewBlogTemplateFile('readme.txt');
        $response = $this->getLayouts();

        // Is there only one layout returned
        $this->assertCount(1, $response);
        // Is the stored key in the collection
        $this->assertTrue($response->contains('default'));
        // Is the displayed value in the collection
        $this->assertTrue($response->has('vendor.easel.frontend.blog.post'));
    }

    public function test_blade_php_files_in_sub_folders_are_ignored()
    {
        $this->createNewBlogTemplateFile('partials'.DIRECTORY_SEPARATOR.'header.blade.php');
        $response = $this->getLayouts();

        // Is there only one layout returned
        $this->assertCount(1, $response);
        // Is the stored key in the collection
        $this->assertTrue($response->contains('default'));
        // Is the displayed value in the collection
        $this->assertTrue($response->has('vendor.easel.frontend.blog.post'));
    }
}
