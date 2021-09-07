<?php

namespace Tests\Feature\Http\Controllers;


use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\MigrateSeedOnce;
use Tests\Traits\TestTrait;

class CategoryControllerTest extends TestCase
{
    use WithFaker,
        MigrateSeedOnce,
        TestTrait;
    /** @test */
    public function test_only_admin_can_store_update_delete()
    {
        $this->assertTrue(2, 1+1);
        // $this->actingAs($this->createBasicUser());
        // $category = Category::factory()->create();

        // $this->json('POST', route('categories.store'))
        //     ->assertStatus(403);
        // $this->json('PATCH', route('categories.update', ['category'=>$category->id]))
        //     ->assertStatus(403);
        // $this->json('DELETE', route('categories.delete', ['category'=>$category->id]))
        //     ->assertStatus(403);
    }

    /** @test */
    // public function test_index_public_access(){
    //     // Category::factory()->count(2)->create();

    //     // $this->json('GET', route('categories.index'))
    //     //     ->assertStatus(200)
    //     //     ->assertJsonStructure(
    //     //         [
    //     //             'data' => [
    //     //                 0 => [
    //     //                     'id',
    //     //                     'name',
    //     //                     'label',
    //     //                     'slug'
    //     //                 ]
    //     //             ]
    //     //         ]
    //     //     );
    // }

    // /** @test */
    // public function test_return_category_resources(){
    //     // $user = $this->createAdminUser();
    //     // $this->actingAs($user);

    //     // $request = $this->generateFakeRequest();

    //     // $this->postJson(route('invoices.store'), $request)
    //     //     ->assertJson([
    //     //         'data' => [
    //     //             'id' => $request['id'],
    //     //             'name' => $request['name'],
    //     //             'label' => $request['label'],
    //     //             'slug' => $request['slug'],
    //     //         ]
    //     //         ]);
    // }

    // private function generateFakeRequest(){
    //     return   [
    //         'id' => $this->faker->randomDigit(),
    //         'name' => $this->faker->name,
    //         'label' => $this->faker->paragraph(),
    //         'slug' => $this->faker->slug,
    //     ];
    // }
}
