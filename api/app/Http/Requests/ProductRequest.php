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
        // if (!$this->images) {
        //     $this->merge([
        //         'images' => [],
        //     ]);
        // }

        $this->merge([
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'numeric'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image']
        ];
    }
}
