<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        $rules =   [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['string'],
            'address' => ['required', 'string'],
            'address_area_id' => ['required', 'string']
        ];

        if (Auth::user()->is('superadmin')) {
            array_push($rules['role_id'], ['required', 'string', 'exists:roles,_id']);
        }

        if (request()->isMethod('post')) {
            array_push($rules['password'], 'required');
        }

        if (request()->isMethod('put') || request()->isMethod('patch')) {
            array_push($rules['password'], 'nullable');
        }


        return $rules;
    }
}
