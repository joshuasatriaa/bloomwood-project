<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Cache;

class MostGiftedController extends Controller
{
    protected $numberOfProducts;

    public function __construct()
    {
        $this->numberOfProducts = 4;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $key = 'most-gifted-products';

        $this->modifyNumberOfProducts();

        return Cache::remember($key . "{$this->numberOfProducts}", now()->addDay(), function () {
            return $this->getProductsResource();
        });
    }

    protected function modifyNumberOfProducts(): void
    {
        if (request('limit') && is_numeric(request('limit'))) {
            $this->numberOfProducts = request('limit');
        }
    }

    protected function getProductsResource(): ResourceCollection
    {
        $idsWithCounter = $this->getAllProductIdsInInvoicesWithCounter();
        $onlyChosenIds = $this->getMaxProductIds($idsWithCounter);

        $realCountOfChosenIds = count($onlyChosenIds);
        $missingIdCount = $this->numberOfProducts - $realCountOfChosenIds;

        if ($realCountOfChosenIds < $this->numberOfProducts) {
            $missingProductIds = Product::whereNotIn('_id', $onlyChosenIds)->get()->random($missingIdCount)->pluck('id')->toArray();
            $onlyChosenIds = array_merge($onlyChosenIds, $missingProductIds);
        }


        return ProductResource::collection(Product::whereIn('_id', $onlyChosenIds)->get());
    }

    protected function getMaxProductIds(array $idsWithCounter): array
    {
        $onlyChosenIds = [];
        arsort($idsWithCounter);

        $takeElements = array_slice($idsWithCounter, 0, $this->numberOfProducts, true);
        $onlyChosenIds = array_keys($takeElements);

        return $onlyChosenIds;
    }

    protected function getAllProductIdsInInvoicesWithCounter(): array
    {
        $invoices = Invoice::all();
        $ids = [];
        foreach ($invoices as $invoice) {
            foreach ($invoice->products_detail as $product) {
                if (!isset($ids[$product['id']])) {
                    $ids[$product['id']] = 1;
                    continue;
                }

                $ids[$product['id']] += 1;
            }
        }

        return $ids;
    }
}
