<?php


namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class ProductVariantControllerTest extends TestCase{

    
    /**@test */
    public function test_only_superadmin_can_destroy(){
        $this->json('DELETE', route('product-variants.destroy', ['productaddon'=>'-1']))
            ->assertStatus(401);
    }

    
}