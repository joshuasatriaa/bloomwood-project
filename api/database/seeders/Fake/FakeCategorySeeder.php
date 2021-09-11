<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use Database\Seeders\Traits\FakeImageTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FakeCategorySeeder extends Seeder
{
    use FakeImageTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('category-images');
        Storage::disk('public')->makeDirectory('category-images');


        $imageSeed = 'category.jpg';

        $categories = [
            [
                'name' => 'Bouquet',
                'parent_id' => null
            ],
            [
                'name' => 'Gift',
                'parent_id' => null
            ],
            [
                'name' => 'Box',
                'parent_id' => null
            ],
            [
                'name' => 'Basket',
                'parent_id' => null
            ],
            [
                'name' => 'Limited',
                'parent_id' => null
            ],
            [
                'name' => 'Collection',
                'parent_id' => null
            ],
        ];

        $children = [
            [
                'name' => 'Sub Bouquet 1',
            ],
            [
                'name' => 'Sub Bouquet 2',
            ],
            [
                'name' => 'Sub Bouquet 3',
            ]
        ];

        foreach ($categories as $c) {
            $image = $this->saveThumbImages($imageSeed, 'category-images');

            Category::create([
                'name' => $c['name'],
                'parent_id' => $c['parent_id'],
                'thumbnail_image' => $image
            ]);
        }

        $bouquet = Category::where('name', 'Bouquet')->first();

        foreach ($children as $child) {
            Category::create([
                'name' => $child['name'],
                'parent_id' => $bouquet->id,
                'thumbnai_image' => null
            ]);
        }
    }
}
