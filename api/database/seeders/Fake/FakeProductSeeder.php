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

        $variantImages = collect([
            'variant-1.jpg',
            'variant-2.jpg',
            'variant-3.jpg',
        ]);

        $addOns = collect([
            [
                'name' => 'Box',
                'image' => 'add-box.jpg'
            ],
            [
                'name' => 'Card',
                'image' => 'add-card.jpg'
            ],
            [
                'name' => 'Ribbon',
                'image' => 'add-ribbon.jpg'
            ],
            [
                'name' => 'Wine',
                'image' => 'add-wine.jpg'
            ],
        ]);

        $variants = collect([
            'blue',
            'red',
            'green'
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

            for ($x = 0; $x < random_int(1, 2); $x++) {
                $data =
                    [
                        'name' => $variants->random(1)->first(),
                        'price' => 50000,
                        'thumbnail_image' => $this->saveThumbImages($variantImages->random(1)->first(), $this->IMAGE_FOLDER)
                    ];

                $p->productVariants()->create($data);
            }

            for ($x = 0; $x < random_int(1, 4); $x++) {
                $rand = $addOns->random(1)->first();
                $data =
                    [
                        'name' => $rand['name'],
                        'price' => 10000,
                        'thumbnail_image' => $this->saveThumbImages($rand['image'], $this->IMAGE_FOLDER)
                    ];

                $p->productAddOns()->create($data);
            }

            $this->saveImages($randomImages, $p, 'productImages', $this->IMAGE_FOLDER);

            $this->categoryService->attachModelToCategories($p, $randomCategory, 'products');
        }
    }
}
