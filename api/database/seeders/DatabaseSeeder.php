<?php

namespace Database\Seeders;

use Database\Seeders\Fake\FakeAddressAreaSeeder;
use Database\Seeders\Fake\FakeCategorySeeder;
use Database\Seeders\Fake\FakeInvoiceSeeder;
use Database\Seeders\Fake\FakeProductSeeder;
use Database\Seeders\Fake\FakeRoleSeeder;
use Database\Seeders\Fake\FakeUserPinSeeder;
use Database\Seeders\Fake\FakeUserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FakeRoleSeeder::class,
            FakeUserSeeder::class,
            FakeUserPinSeeder::class,
            FakeCategorySeeder::class,
            FakeProductSeeder::class,
            FakeAddressAreaSeeder::class,
            // FakeInvoiceSeeder::class
        ]);
    }
}
