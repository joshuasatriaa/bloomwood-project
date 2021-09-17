<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\TestTrait;
use Tests\Traits\MigrateSeedOnce;


class UserControllerTest extends TestCase {

    use MigrateSeedOnce,
        WithFaker,
        TestTrait; 

    /* @test */
    public function test_only_superadmin_can_access_method(){
        $user = User::factory()->create();
        $this->getJson(route('users.index'))
            ->assertStatus(401);
        $this->postJson(route('users.store'), [])
            ->assertStatus(401);
        $this->getJson(route('users.show', ['user'=>'-1']))
            ->assertStatus(401);
        $this->putJson(route('users.update', ['user'=>'-1']))
            ->assertStatus(401);
        $this->json('DELETE', route('users.destroy', ['user'=>'-1']))
            ->assertStatus(401);
        $this->json('POST','/api/suspend-user/'.$user, ['user'=>'-1',])
            ->assertStatus(401);
        $this->json('POST','/api/unsuspend-user/'.$user, ['user'=>'-1'])
            ->assertStatus(401);
    }

    /**@test */
    public function test_index_function(){  
        $user = $this->createSuperAdminUser();

        $this->actingAs($user)
            ->getJson(route('users.index'))
            ->assertStatus(200)
            ->assertJson([
                'uuid'
            ])
            ->assertJsonStructure([
                'data' => [
                        'uuid',
                        'id',
                        'name',
                        'email',
                        'phone_number',
                        'role',
                        'has_pin',
                        'is_suspended',
                        'addresses'
                    ]
            ]);
    }

    /** @test */
    public function test_store_function(){
        $user = $this->createSuperAdminUser();

        $request = [
            'name'=> $this->faker->name,
            'email'=> $this->faker->email,
            'password'=>$this->faker->password,
            'role_id'=>$this->generateUserRoleID()
        ];
        
        $this->actingAs($user)
            ->json('POST', route('users.store'), $request)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name'=>$request['name'],
                    'email'=>$request['email'],
                ]
            ])
            ->assertJsonStructure([
                'data' => [
                    'uuid',
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'role',
                    'has_pin',
                    'is_suspended',
                    'addresses'
                ]
            ]);
        
        $this->assertDatabaseHas('users', 
            [
                'name'=>$request['name'],
                'email'=>$request['email'],
            ]
        );

    }

    /**@test */
    public function test_show_function(){
        $user = $this->createSuperAdminUser();
        $user2 = User::factory()->create();
        $this->actingAs($user)
            ->json('GET', route('users.show', ['user'=>$user2]))
            ->assertJson([
                'data' => [
                    'uuid' => $user2->id,
                    'id' => $user2->id,
                    'name' => $user2->name,
                    'email' => $user2-> email,
                    'phone_number' => $user2->phone_number,
                    'is_suspended' => (bool) $user2->is_suspended,
                    'addresses' => $user2->addresses
                ]
            ])
            ->assertJsonStructure(
                [
                    'data' => [
                        
                            'uuid',
                            'id',
                            'name',
                            'email',
                            'phone_number',
                            'role',
                            'has_pin',
                            'is_suspended',
                            'addresses'
                        
                    ]
                ]
            );
    }

    /**@test */
    public function test_update_function(){
        $user = $this->createSuperAdminUser();

        $user2 = $this->createBasicUser();
        $data = [
            'name'=>'John Doe', 
            'email'=>'123123@test.com',
            'role_id'=>$this->generateUserRoleID() 
        ];
        $this->actingAs($user)
            ->json('PATCH', route('users.update', ['user'=>$user2]), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'uuid',
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'role',
                    'has_pin',
                    'is_suspended',
                    'addresses'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'name'=>'John Doe',
            'email'=>'123123@test.com'
        ]);
    }

    /**@test */
    public function test_suspend_function(){
        $admin = $this->createSuperAdminUser();
        $user = $this->createBasicUser();

        $this->actingAs($admin)
            ->json('POST','/api/suspend-user/', ['user'=>$user])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'uuid',
                        'id',
                        'name',
                        'email',
                        'phone_number',
                        'role',
                        'has_pin',
                        'is_suspended',
                        'addresses'
                    ]
                ]
            ]);
            
    }

    /**@test */
    public function test_unsuspend_function(){
        $user = $this->createSuperAdminUser();
        $user2 = User::factory()->create();

        $this->actingAs($user)
            ->json('POST','/api/unsuspend-user', ['user'=>$user2])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'uuid',
                        'id',
                        'name',
                        'email',
                        'phone_number',
                        'role',
                        'has_pin',
                        'is_suspended',
                        'addresses'
                    ]
                ]
            ]);
    }

    private function generateUserRoleID(){
        $role = Role::firstOrCreate(
            [
                'slug' => 'customer'
            ],
            [
                'name' => 'Customer'
            ]
        );

        return $role->id;
    }
}   