<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->is(config('constants.superadmin.slug')) || $this->user()->is(config('constants.admin.slug'));
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'parent_id' => ['sometimes', 'nullable', 'exists:categories,_id'],
            'thumbnail_image' => ['sometimes', 'nullable', 'image']
        ];
    }
}
