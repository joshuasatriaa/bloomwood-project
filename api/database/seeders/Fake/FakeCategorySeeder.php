<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use Illuminate\Database\Seeder;

class FakeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Bouquet',
            'Gift',
            'Flowers',
            'Box',
            'Basket',
            'Limited',
            'Collection'
        ];

        foreach ($categories as $c) {
            Category::create([
                'name' => $c
            ]);
        }
    }
}
