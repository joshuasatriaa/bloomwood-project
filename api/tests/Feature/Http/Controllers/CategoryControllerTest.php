<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\TestTrait;
use Tests\Traits\MigrateSeedOnce;

class CategoryControllerTest extends TestCase
{
    use MigrateSeedOnce,
        WithFaker,
        TestTrait; 
    /** @test */
    public function test_only_admin_can_store_update_delete()
    {
        //1A
        $this->postJson(route('categories.store'), [])
            ->assertStatus(401);
        $this->putJson(route('categories.update', ['category'=>'-1']))
            ->assertStatus(401);
        $this->json('DELETE', route('categories.destroy', ['category'=>'-1']))
            ->assertStatus(401);
    }

    /** @test */
    public function test_index_public_access(){
        //1B, 1C, 1D
        Category::factory()->count(2)->create();

        $this->json('GET', route('categories.index'))
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        0 => [
                            'id',
                            'name',
                            'label',
                            'slug'
                        ]
                    ]
                ]
            );
    }

    /** @test */
    public function test_search_category(){
        $category = Category::factory()->create();
        $this->json('GET', route('categories.index', ['search'=>$category->name]))
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        0 => [
                            'id',
                            'name',
                            'label',
                            'slug'
                        ]
                    ]
                ]
            );
    }

    /** @test */
    public function test_store_function(){
        $user = $this->createAdminUser();
        $this->actingAs($user);

        $request = ['name'=>'test'];

        $this->json('POST', route('categories.store'), $request)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $request['name'],
                ]   
            ]);
        
        $this->assertDatabaseHas('categories', [
            'name' => 'test'
        ]);
    }
    
    /** @test */
    public function test_show_function(){
        $test = Category::factory()->create();
        $this->json('GET', route('categories.show', ['category'=>$test]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $test->id,
                ]   
            ]);
    }

    /** @test */
    public function test_update_function(){
        $user = $this->createAdminUser();
        $category = Category::factory()->create();
        $data = ['name' => 'Category Updated.'];


        $this->actingAs($user)
            ->json('PATCH', route('categories.update', ['category' => $category->id]), $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $category->id,
                    'name'=> $data['name'],
                    'label'=>$category->label,
                    'slug'=>$category->slug,
                ]   
            ]);

        $this->assertDatabaseHas('categories', 
            [
                'id'=> $category->id,
                'name'=>$data['name'],
                'label'=>$category->label,
                'slug'=>$category->slug
            ]);
    }

    /** @test */
    public function test_destroy_function(){
        $user = $this->createAdminUser();
        $category = Category::factory()->create();
        $this->actingAs($user)
            ->json('DELETE', route('categories.destroy', ['category'=>$category->id]));
        
        
        $this->assertDatabaseMissing('categories', [$category->id]);
    }
}
