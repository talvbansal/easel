<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 06/04/17
 * Time: 17:08.
 */

namespace Easel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'display_name' => 'required',
            'email'        => 'required|unique:users|email',
            'password'     => 'required',
        ];
    }
}
