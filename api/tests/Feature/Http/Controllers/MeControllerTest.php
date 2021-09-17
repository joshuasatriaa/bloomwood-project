<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\TestTrait;
use Tests\Traits\MigrateSeedOnce;

class MeControllerTest extends TestCase {

    use MigrateSeedOnce,
        WithFaker,
        TestTrait; 
    
    
    /** @test */

    public function test_result_user_resource(){
        $user = $this->createBasicUser();


        $this->actingAs($user)
            ->json('GET', '/api/user')
            ->assertJson(
                [
                    'data' => [ 
                        'uuid' => $user->id,
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'role' => [
                            'uuid'  =>  $user->role->id,
                            'id'    =>  $user->role->id,
                            'name'  =>  $user->role->name,
                            'slug'  =>  $user->role->slug
                        ],
                        'is_suspended' => (bool) $user->is_suspended,
                    ]
                ]
                    );
        
        $this->assertIsObject($user->role);   
    }












}