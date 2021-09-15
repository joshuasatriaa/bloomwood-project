<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User as ModelsUser;
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
        $user = ModelsUser::factory()->create();

        $this->json('GET', route('user', ['user'=>$user, 'role'=>['id'=>1,'name'=>'user']]))
            ->assertJson(
                [
                    'data' => [ 
                        'uuid' => $user->id,
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'role' => [
                            'uuid'  =>  $user->role->uuid,
                            'id'    =>  $user->role->id,
                            'name'  =>  $user->role->name,
                            'slug'  =>  $user->role->slug
                        ],
                        'is_suspended' => $user->is_suspended,
                    ]
                ]
            )
            ->assertIsObject($user->role);
    }












}