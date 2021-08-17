<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Database\Seeder;

class FakeProductSeeder extends Seeder
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('role', function ($query) {
            $query->whereIn('slug', [config('constants.superadmin.slug'), config('constants.admin.slug')]);
        })->get();

        $categories = Category::all();

        for ($i = 0; $i < 100; $i++) {
            $randomCategory = $categories->random(random_int(1, 3))->pluck('id')->toArray();

            $p =  \App\Models\Product::factory([
                'user_id' => $users->random(1)->first()->id
            ])->create();

            $this->categoryService->attachModelToCategories($p, $randomCategory, 'products');
        }
    }
}
