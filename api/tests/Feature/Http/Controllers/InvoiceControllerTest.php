<?php

namespace Tests\Feature\Http\Controllers;

use App\Facades\InvoiceFacade;
use App\Models\AddressArea;
use App\Models\Invoice;
use App\Models\Product;
use App\Services\InvoiceService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\MigrateSeedOnce;
use Tests\Traits\TestTrait;

class InvoiceControllerTest extends TestCase
{
    use WithFaker,
        MigrateSeedOnce,
        TestTrait;

    /** @test */
    public function superadmin_can_list_all_invoices()
    {
        $this->actingAs($this->createSuperAdminUser());

        $countInvoices = Invoice::count();

        $this->getJson(route('invoices.index'))
            ->assertJson([
                'meta' => [
                    'total' => $countInvoices
                ]
            ]);
    }

    /** @test */
    public function admin_can_list_all_invoices()
    {
        $this->actingAs($this->createAdminUser());

        $countInvoices = Invoice::count();

        $this->getJson(route('invoices.index'))
            ->assertJson([
                'meta' => [
                    'total' => $countInvoices
                ]
            ]);
    }

    /** @test */
    public function customer_can_only_list_own_invoices()
    {
        $user = $this->createBasicUser();
        $this->actingAs($user);
        $this->createInvoice($user);

        $countInvoices = Invoice::own()->count();

        $this->getJson(route('invoices.index'))
            ->assertJson([
                'meta' => [
                    'total' => $countInvoices
                ]
            ]);
    }

    /** @test */
    public function customer_can_create_invoice()
    {
        $user = $this->createBasicUser();
        $this->actingAs($user);

        $request = $this->generateFakeRequest();

        $this->postJson(route('invoices.store'), $request)
            ->assertJson([
                'data' => [
                    'notes' => $request['notes'],
                    'address' => $request['address'],
                    'pick_up' => $request['pick_up'],
                    'products_detail' => [
                        [
                            'id' => $request['products'][0]['id']
                        ]
                    ]
                ]
            ])
            ->assertStatus(201);
    }

    /** @test */
    public function customer_can_not_show_others_invoice()
    {
        $user = $this->createBasicUser();
        $userTwo = $this->createBasicUser();

        $invoice = $this->createInvoice($user);

        $this->actingAs($userTwo);
        $this->getJson(route('invoices.show', ['invoice' => $invoice->id]))
            ->assertStatus(403);
    }

    /**
     * Private Functions
     */

    private function generateFakeRequest(): array
    {
        return   [
            'notes' => $this->faker->paragraph(),
            'address' => $this->faker->address,
            'address_area_id' => $this->getRandomAddressArea()->id,
            'pick_up' => 0,
            'products' => $this->getRandomProductsToBuy(),
        ];
    }

    private function createInvoice($user): Invoice
    {
        $this->actingAs($user);

        $request = $this->generateFakeRequest();

        $invoiceFacade = new InvoiceFacade(new InvoiceService(), $request);
        $invoice = $invoiceFacade->generate();

        return $invoice;
    }

    private function getRandomAddressArea(): AddressArea
    {
        return AddressArea::all()->random(1)->first();
    }

    private function getRandomProductsToBuy(): array
    {
        $products = Product::all();

        $randomProducts = $products->random(2)->all();

        $productDetails = [];
        foreach ($randomProducts as $p) {
            $item = [
                'id' => $p->id,
                'variant_id' => '',
                'add_ons' => []
            ];

            if ($p->productVariants()->count() > 0) {
                $variants = $p->productVariants()->first();
                $item['variant_id'] = $variants->id;
            }

            $addOnsCount = $p->productAddOns()->count();
            if ($addOnsCount > 0) {
                for ($i = 0; $i < random_int(1, $addOnsCount); $i++) {
                    array_push($item['add_ons'], [
                        'id' => $p->productAddOns()->get()->random(1)->first()->id
                    ]);
                }
            }

            array_push($productDetails, $item);
        }

        return $productDetails;
    }
}
