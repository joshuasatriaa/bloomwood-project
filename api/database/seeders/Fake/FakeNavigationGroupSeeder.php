<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use App\Models\NavigationGroup;
use Illuminate\Database\Seeder;

class FakeNavigationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'Events',
            'Flowers',
            'Eternity Collection',
            'Gift',
            'Wedding Flowers',
        ];

        $categories = Category::all();

        foreach ($groups as $g) {
            $ng = NavigationGroup::create([
                'name' => $g
            ]);

            $randomCategories = $categories->random(random_int(1, 5))->pluck('id')->toArray();
            $ng->categories()->sync($randomCategories);
        }
    }
}
