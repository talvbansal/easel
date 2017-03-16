<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 16/03/17
 * Time: 10:55.
 */

namespace Easel\Services;

use Easel\Models\Category;

class CategoryManager
{
    private $fields = [
        'name'       => '',
        'slug'       => '',
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
        $category = new Category();
        $category->fill($data)->save();

        return $category->save();
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    public function edit($id, $data)
    {
        $category = Category::findOrFail($id);
        $category->fill($data);

        return $category->save();
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return Category::destroy($id);
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
            $data = Category::findOrFail($id)->toArray();
        } else {
            $data = $this->fields;
        }

        return $data;
    }
}
