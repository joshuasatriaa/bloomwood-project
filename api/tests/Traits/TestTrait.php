<?php

namespace Tests\Traits;

use App\Models\Role;
use App\Models\User;

trait TestTrait
{

    public function createBasicUser(): User
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(
            [
                'slug' => 'customer'
            ],
            [
                'name' => 'Customer'
            ]
        );

        $user->role_id = $role->id;
        $user->save();

        return $user;
    }

    public function suspendUser(User $user): User
    {
        $user->is_suspended = true;
        $user->save();

        return $user;
    }

    public function createSuperAdminUser(): User
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(
            [
                'slug' => 'superadmin'
            ],
            [
                'name' => 'Super Admin'
            ]
        );
        $user->role_id = $role->id;
        $user->save();

        return $user;
    }

    public function createAdminUser(): User
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(
            [
                'slug' => 'admin'
            ],
            [
                'name' => 'Admin'
            ]
        );
        $user->role_id = $role->id;
        $user->save();

        return $user;
    }
}
