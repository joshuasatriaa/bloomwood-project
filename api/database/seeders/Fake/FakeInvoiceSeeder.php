<?php

namespace Database\Seeders\Fake;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakeInvoiceSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker->create();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        $i = 0;
        while ($i < 10) {
            $user = $users->random(1)->first();
            $purchaseProducts = $products->random(random_int(1, 2))->get();

            $invoice = new Invoice;
            $invoice->user_id = $user->id;
            $invoice->invoice_number = $invoice->generateInvoiceNumber();
            $invoice->notes = $this->faker->paragraph(5);

            $i++;
        }
    }
}
