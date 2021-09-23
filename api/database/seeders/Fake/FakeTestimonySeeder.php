<?php

namespace Database\Seeders\Fake;

use App\Models\Testimony;
use Illuminate\Database\Seeder;

class FakeTestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimony::factory()->count(10)->create();
    }
}
