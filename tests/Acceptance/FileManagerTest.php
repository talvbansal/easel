<?php

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 12/08/16
 * Time: 13:33.
 */
class FileManagerTest extends TestCase
{
    /**
     * @var \Easel\Models\User
     */
    private $user;

    /**
     * Create the user model test subject.
     *
     * @before
     *
     * @return void
     */
    public function createUser()
    {
        $this->user = factory(\Easel\Models\User::class)->create();
    }

    public function test_can_create_a_folder()
    {
        $this->actingAs($this->user)
            ->json('POST', '/admin/browser/folder', ['new_folder' => 'testFolderName', 'folder' => '/'])
            ->seeJson([
                'success' => trans('easel::messages.create_success', ['entity' => 'folder']),
            ]);
    }
}
