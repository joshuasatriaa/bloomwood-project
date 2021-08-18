<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id,
            'slug' => Str::slug($this->name),
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'string'],
            'images' => ['sometimes', 'array'],
            'images.*' => ['sometimes', 'image']
        ];
    }
}
