<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 06/04/17
 * Time: 17:10.
 */

namespace Easel\Http\Requests;

use Easel\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'        => 'required|email',
        ];
    }
}
