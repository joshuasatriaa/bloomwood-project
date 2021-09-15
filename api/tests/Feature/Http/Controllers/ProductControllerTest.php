<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\TestTrait;
use Tests\Traits\MigrateSeedOnce;

class ProductControllerTest extends TestCase {

    use MigrateSeedOnce,
        WithFaker,
        TestTrait;

    /**@test */
    public function test_only_superadmin_can_access_method(){
        $this->getJson(route('products.index'))
            ->assertStatus(401);
        $this->postJson(route('products.store'), [])
            ->assertStatus(401);
        $this->getJson(route('products.show', ['product'=>'-1']))
            ->assertStatus(401);
        $this->putJson(route('products.update', ['product'=>'-1']))
            ->assertStatus(401);
        $this->json('DELETE', route('products.destroy', ['product'=>'-1']))
            ->assertStatus(401);
    }





}