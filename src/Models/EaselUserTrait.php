<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 02/08/16
 * Time: 07:56
 */

namespace Easel\Models;

trait EaselUserTrait
{
    /**
     * @param $value
     *
     * @return array
     */
    public function getSocialMediaAttribute( $value )
    {
        return  json_decode( $value );
    }


}