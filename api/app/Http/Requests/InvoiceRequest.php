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
        $rules = [
            'notes' => ['present', 'nullable', 'string'],
            'recipients_name' => ['string'],
            'recipients_phone' => ['string'],
            'delivery_time' => ['date'],
            'address' => ['string'],
            'address_area_id' => ['string'],
            'pick_up' => ['required', 'boolean'],

            'products' => ['required', 'array', new ProductSizeExistsRule],
            'products.*.id' => ['required', 'string'],
            'products.*.message' => ['present', 'nullable', 'string'],
            'products.*.size' => ['required', 'string', Rule::in(['Classic', 'Deluxe'])],
            'products.*.variant_id' => ['present', 'nullable', 'string', 'exists:product_variants,_id'],
            'products.*.add_ons' => ['required', 'array'],
            'products.*.add_ons.*.id' => ['present', 'nullable', 'string', 'exists:product_add_ons,_id'],
        ];

        $props = [
            'recipients_name',
            'recipients_phone',
            'delivery_time',
            'address',
            'address_area_id',
            'delivery_time'
        ];

        switch ($this->pick_up) {
            case 0:  // pickup false
                foreach ($props as $item) {
                    array_unshift($rules[$item], 'required');
                }
                break;
            case 1: // pickup true
                foreach ($props as $item) {
                    array_unshift($rules[$item], 'nullable');
                    array_unshift($rules[$item], 'present');
                }
                break;
        }

        return $rules;
    }
}
