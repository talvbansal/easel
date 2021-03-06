<?php

namespace Easel\Http\Requests;

class TagUpdateRequest extends Request
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
      'title'    => 'required',
      'subtitle' => 'required',
      'layout'   => 'required',
    ];
  }
}
