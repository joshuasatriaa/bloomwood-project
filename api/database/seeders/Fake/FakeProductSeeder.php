<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use Illuminate\Database\Seeder;

class FakeProductSeeder extends Seeder
{
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

        for ($i = 0; $i < 100; $i++) {
            \App\Models\Product::factory([
                'user_id' => $users->random(1)->first()->id
            ])->create();
        }
    }
}
