<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 03/08/16
 * Time: 08:28.
 */

namespace Easel\Http\Requests;

class PasswordUpdateRequest extends Request
{
    /**
     * The user must be authorised to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation rules for password change.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'     => 'required',
            'new_password' => 'required|confirmed|min:6',
        ];
    }
}
