<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use App\Rules\ProductSizeExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'recipients_name' => ['required', 'nullable', 'string'],
            'recipients_phone' => ['required', 'nullable', 'string'],
            'delivery_time' => ['required', 'nullable',  'date'],
            'address' => ['required', 'nullable', 'string'],
            'address_area_id' => ['required', 'nullable', 'string'],
            'pick_up' => ['required', 'boolean'],

            'products' => ['required', 'array', new ProductSizeExistsRule],
            'products.*.id' => ['required', 'string'],
            'products.*.message' => ['required', 'nullable', 'string'],
            'products.*.size' => ['required', 'string', Rule::in(['Classic', 'Deluxe'])],
            'products.*.variant_id' => ['required', 'nullable', 'string', 'exists:product_variants,_id'],
            'products.*.add_ons' => ['required', 'array'],
            'products.*.add_ons.*.id' => ['nullable', 'present', 'string', 'exists:product_add_ons,_id'],
        ];
    }
}
