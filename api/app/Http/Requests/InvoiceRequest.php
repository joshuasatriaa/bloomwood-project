<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InvoiceRequest extends FormRequest
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
            'notes' => ['required', 'string'],
            'address' => ['required', 'string'],
            'address_area_id' => ['required', 'string'],
            'pick_up' => ['required', 'boolean'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'string'],
            'products.*.variant_id' => ['required', 'nullable', 'string'],
            'products.*.add_ons' => ['required', 'array'],
            'products.*.add_ons.*.id' => ['nullable', 'present', 'string'],
        ];
    }
}
