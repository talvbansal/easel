<?php

namespace Easel\Http\Requests;

use Carbon\Carbon;

class PostCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
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
            'title'        => 'required',
            'slug'         => 'required',
            'subtitle'     => 'required',
            'content'      => 'required',
            'published_at' => 'required',
            'category_id'  => 'required|numeric',
        ];
    }

    /**
     * Return the fields and values to create a new post from.
     */
    public function postFillData()
    {
        return [
            'title'            => $this->title,
            'slug'             => $this->slug,
            'subtitle'         => $this->subtitle,
            'page_image'       => $this->page_image,
            'content_raw'      => $this->get('content'),
            'meta_description' => $this->meta_description,
            'is_draft'         => (bool) $this->is_draft,
            'published_at'     => Carbon::createFromFormat('d/m/Y H:i:s', $this->published_at)->format('Y-m-d H:i:s'),
            'author_id'        => ($this->author_id) ?: auth()->user()->id,
            'category_id'      => $this->category_id,
        ];
    }
}
