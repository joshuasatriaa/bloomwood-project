<?php


namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class ProductAddOnControllerTest extends TestCase{

    
    /**@test */
    public function test_only_superadmin_can_destroy(){
        $this->json('DELETE', route('product-add-ons.destroy', ['productaddon'=>'-1']))
            ->assertStatus(401);
    }

    
}