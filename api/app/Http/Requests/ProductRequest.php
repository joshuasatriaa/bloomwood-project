<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        if ($this->variants['0']['thumbnail_image'] === 'null') {
            $this->merge([
                'variants' => [
                    [
                        'name' => null,
                        'thumbnail_image' => null
                    ]
                ]
            ]);
        }

        if ($this->add_ons['0']['thumbnail_image'] === 'null') {
            $this->merge([
                'add_ons' => [
                    [
                        'name' => null,
                        'thumbnail_image' => null
                    ]
                ]
            ]);
        }

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
            'sizes' => ['required', 'array'],
            'sizes.*.name' => ['required', 'string', Rule::in(['Classic', 'Deluxe'])],
            'sizes.*.price' => ['required', 'numeric'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'string'],
            'images' => ['sometimes', 'array'],
            'images.*' => ['sometimes', 'image'],
            'variants' => ['sometimes', 'nullable', 'array'],
            'variants.*.name' => ['sometimes', 'nullable', 'string'],
            'variants.*.price' => ['sometimes', 'nullable', 'numeric'],
            'variants.*.thumbnail_image' => ['sometimes', 'nullable', 'image'],
            'add_ons' => ['sometimes', 'nullable', 'array'],
            'add_ons.*.name' => ['sometimes', 'nullable', 'string'],
            'add_ons.*.price' => ['sometimes', 'nullable', 'numeric'],
            'add_ons.*.thumbnail_image' => ['sometimes', 'nullable', 'image']
        ];
    }
}
