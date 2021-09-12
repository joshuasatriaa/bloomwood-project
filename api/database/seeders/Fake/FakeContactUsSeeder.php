<?php

namespace Database\Seeders\Fake;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class FakeContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::factory()->count(40)->create();
    }
}
