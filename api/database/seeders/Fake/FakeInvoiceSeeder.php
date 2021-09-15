<?php

namespace Database\Seeders\Fake;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Collection;

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
        $users = User::whereHas('role', function ($q) {
            return $q->whereNotIn('slug', ['superadmin', 'admin']);
        })->get();
        $products = Product::all();

        $i = 0;
        while ($i < 50) {
            $user = $users->random(1)->first();
            $purchaseProducts = $products->random(random_int(1, 2))->all();
            $randomAddress = $user->customerAddresses()->get()->random(1)->first();
            $addressArea =  $randomAddress->addressArea;

            $pickup = $this->faker->randomElement([0, 1]);
            $productDetails = $this->generateProductsDetail($purchaseProducts);
            $deliveryFee = $pickup ? 0 : $this->defineDeliverFee($productDetails, $addressArea);

            $invoice = new Invoice;
            $invoice->invoice_number = $invoice->generateInvoiceNumber();
            $invoice->notes = $this->faker->paragraph(5);
            $invoice->status = $this->faker->randomElement(['pending', 'paid', 'processed', 'delivered']);
            $invoice->recipients_name = $pickup ? null : $this->faker->name();
            $invoice->recipients_phone = $pickup ? null : $this->faker->phoneNumber;
            $invoice->delivery_time =  $pickup ? null : $this->faker->date();
            $invoice->address = $pickup ? null : $randomAddress->address;
            $invoice->address_area = $pickup ? null : $this->copyAddressArea($addressArea);
            $invoice->pick_up = $pickup;

            $invoice->products_detail = $productDetails;
            $invoice->delivery_fee =  $deliveryFee;
            $invoice->grand_total = $this->calculateGrandTotal($productDetails, $deliveryFee);

            $invoice->save();

            $invoice->user_id = $user->id;
            $invoice->save();

            $i++;
        }
    }

    private function copyAddressArea($addressArea)
    {
        return  [
            'id' => $addressArea->id,
            'province' => $addressArea->province,
            'city' => $addressArea->city,
            'district' => $addressArea->district,
            'urban' => $addressArea->urban,
            'postal_code' => $addressArea->postal_code,
            'small_price' => $addressArea->small_price,
            'medium_price' => $addressArea->medium_price,
        ];
    }

    private function calculateGrandTotal($productDetails, $deliveryFee)
    {
        $total = 0;

        foreach ($productDetails as $p) {
            $total += $p['total_price'];
        }

        return $total + $deliveryFee;
    }

    private function defineDeliverFee($purchaseProducts, $addressArea)
    {
        $sizes = [];
        foreach ($purchaseProducts as $p) {
            array_push($sizes, $p['size']);
        }

        if (count($sizes) > 1) {
            return $addressArea->medium_price;
        }

        if (count($sizes) == 1 && $sizes[0]['name'] == config('constants.sizes.deluxe')) {
            return $addressArea->medium_price;
        }

        return $addressArea->small_price;
    }

    private function generateProductsDetail(array $products): array
    {
        $res = [];
        foreach ($products as $p) {
            $total_price = 0;
            $countAddOns = $p->productAddOns()->count();
            $sizes = collect($p->sizes);

            $randomVar = $p->productVariants()->exists() ? $p->productVariants()->get()->random(1)->first() : false;
            $randomSize = $sizes->random(1)->first();
            $randomAddOns = $p->productAddOns()->get()->random(random_int(0, $countAddOns))->all();
            $thumbnail = $p->productImages()->first();

            $item =  [
                'id' => $p['id'],
                'name' => $p['name'],
                'size' => $randomSize,
                'price' => $randomSize['price'],
                'message' => 'lorem ipsum message',
                'thumbnail_image' => $thumbnail->thumbnail_image,
                'variant' => [],
                'add_ons' => [],
                'total_price'  => 0,
            ];

            $total_price = $item['price'];

            if ($randomVar) {
                $item['variant'] = [
                    'id' => $randomVar->id,
                    'name' => $randomVar->name,
                    'price' => $randomVar->price,
                    'thumbnail_image' => $randomVar->thumbnail_image
                ];

                $total_price += $randomVar->price;
            }

            if (count($randomAddOns) > 0) {
                foreach ($randomAddOns as $ao) {
                    array_push(
                        $item['add_ons'],
                        [
                            'id' => $ao['id'],
                            'name' => $ao['name'],
                            'price' => $ao['price'],
                            'thumbnail_image' => $ao['thumbnail_image']
                        ]
                    );
                    $total_price += $ao['price'];
                }
            }

            $item['total_price'] = $total_price;

            array_push($res, $item);
        }

        return $res;
    }
}
