<?php

namespace Easel\Http\Requests;

class ProfileUpdateRequest extends Request
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
            'email'        => 'required',
            'job'          => 'required',
            'city'         => 'required',
            'country'      => 'required',
        ];
    }
}
