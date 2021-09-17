<?php


namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\TestTrait;
use Tests\Traits\MigrateSeedOnce;

class ProductVariantControllerTest extends TestCase{

    use MigrateSeedOnce,
        WithFaker,
        TestTrait;

    /**@test */
    public function test_only_superadmin_can_destroy(){

        $this->json('DELETE', route('product-variants.destroy', ['product_variant'=>'-1']))
            ->assertStatus(401);
    }


    /**@test */
    public function test_image_deleted(){
        $product = Product::factory()->create();

        $this->json('DELETE', route('product-variants.destroy', ['product_variant'=>$product]))
            ->assertStatus(204);

        $this->assertSoftDeleted($product);
    }

    
}