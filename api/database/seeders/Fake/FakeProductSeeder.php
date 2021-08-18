<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\ImageService;
use Database\Seeders\Traits\FakeImageTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FakeProductSeeder extends Seeder
{
    use FakeImageTrait;

    protected $categoryService;
    protected $imageService;
    private $IMAGE_FOLDER;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->imageService = new ImageService();
        $this->IMAGE_FOLDER = config('constants.image_folders.product_images');
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory($this->IMAGE_FOLDER);
        Storage::disk('public')->makeDirectory($this->IMAGE_FOLDER);

        $images = collect([
            'flower-1.jfif',
            'flower-2.jfif',
            'flower-3.jfif',
        ]);

        $users = User::whereHas('role', function ($query) {
            $query->whereIn('slug', [config('constants.superadmin.slug'), config('constants.admin.slug')]);
        })->get();

        $categories = Category::all();

        for ($i = 0; $i < 5; $i++) {
            $randomCategory = $categories->random(random_int(1, 3))->pluck('id')->toArray();
            $randomImages = $images->random(random_int(1, 3));

            $p =  \App\Models\Product::factory([
                'user_id' => $users->random(1)->first()->id
            ])->create();

            $this->saveImages($randomImages, $p, 'productImages', $this->IMAGE_FOLDER);

            $this->categoryService->attachModelToCategories($p, $randomCategory, 'products');
        }
    }
}
