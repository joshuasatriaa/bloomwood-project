<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User as ModelsUser;
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

        
    }







}