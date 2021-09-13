<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressAreaRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'small_price' => ['required', 'numeric'],
            'medium_price' => ['required', 'numeric'],
        ];
    }
}
