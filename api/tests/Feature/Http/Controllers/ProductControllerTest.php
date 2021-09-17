<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductAddOnResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductVariantResource;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductAddOn;
use App\Models\ProductImage;
use App\Models\ProductVariant;
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
        $this->postJson(route('products.store', ['product'=>'-1']))
            ->assertStatus(401);
        $this->putJson(route('products.update', ['product'=>'-1']))
            ->assertStatus(401);
        $this->json('DELETE', route('products.destroy', ['product'=>'-1']))
            ->assertStatus(401);
    }

    /**@test */
    public function test_product_resource_contain_all_specified(){
        $user = $this->createBasicUser();
        $admin = $this->createSuperAdminUser();
        $product = Product::factory()->count(2)->create();
        
        $name = $this->faker->word() . ' ' . $this->faker->randomElement(['Flower', 'Bouquet', 'Basket']);
        $request = [
            'user_id'=>$user->id,
            'name'=> $name,
            'description' =>$this->faker->paragraph(),
            'slug'=> Str::slug($name),
            'price' => $this->faker->randomElement([300000, 500000, 800000, 1000000, 2000000, 3000000]),
            'size' => $this->faker->randomElement(['S', 'M']),
            'variants'=> [
                [
                    'name' => '-1',
                    'thumbnail_image' => $this->faker->imageUrl($width = 640, $height = 480)
                    
                ]
            ],
            'add_ons' =>  [
                [
                    'name' => '-1',
                    'thumbnail_image' => $this->faker->imageUrl($width = 640, $height = 480)
                ]
            ]

        ];


        $this->actingAs($admin)
            ->json('POST', route('products.store', $request))
            ->assertStatus(201);
        

        $this->json('GET', route('products.index'))
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'slug',
                    'price',
                    'created_at',
                    'updated_at',
                    'user' => [
                        'id',
                        'name'
                    ],
                    'size',
                    'categories',
                    'images',
                    'variants',
                    'addons',
                ]
            ]);
    }

    /**@test */
    public function test_index_function(){
        $product = Product::factory()->create();
        $this->json('GET', route('products.index', ['search'=>$product->name]))
            ->assertStatus(201)
            ->assertJsonStructure([
                'data'=>[
                    'id',
                    'name',
                    'description',
                    'slug',
                    'price',
                    'created_at',
                    'updated_at',
                    'user',
                    'size',
                    'categories',
                    'images',
                    'variants',
                    'add_ons'
                ]
        ]);
    }

    private function generateFakeProduct(){
        $data = [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(),
            'slug' => Str::slug($this->faker->name),
            'price' => $this->faker->randomElement([300000, 500000, 800000, 1000000, 2000000, 3000000]),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'user' => [
                'id' => $this->faker->uuid,
                'name' => $this->faker->name
            ],
            'size' => $this->faker->randomElement(['S', 'M']),
        ];

        $this->actingAs($this->createSuperAdminUser())
            ->json('POST', route('products.store'), $data)
            ->assertStatus(201);
        
        return $data;
    }

    private function createFakeCategory() : Category{
        $data = Category::factory()->create();
        return $data;
    }



}