<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 21/07/16
 * Time: 12:40.
 */

namespace Easel\Services;

use Easel\Models\Tag;

class TagManager
{

    protected $fields = [
        'name' => '',
        'slug' => '',
        'created_at' => '',
        'updated_at' => '',
    ];

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        $tag = new Tag();
        $tag->fill($data)->save();

        return $tag->save();
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    public function edit($id, $data)
    {
        $tag = Tag::findOrFail($id);
        $tag->fill($data);

        return $tag->save();
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return Tag::destroy($id);
    }

    /**
     * @param null $id
     *
     * @return array
     */
    public function getViewData($id = null)
    {
        if ($id !== null) {
            /** @var $data */
            $data = Tag::findOrFail($id)->toArray();
        } else {
            $data = $this->fields;
        }

        return $data;
    }
}
