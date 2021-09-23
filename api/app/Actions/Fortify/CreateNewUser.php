<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'address' => ['required', 'string'],
            'address_area_id' => ['required', 'string'],
            'phone_number' => ['required', 'numeric']
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $this->getCustomerId(),
            'phone_number' => $input['phone_number']
        ]);

        $user->customerAddresses()->create([
            'address' => $input['address'],
            'address_area_id' => $input['address_area_id']
        ]);

        return $user;
    }

    private function getCustomerId(): string
    {
        return Role::where('slug', 'customer')->first()->id;
    }
}
