<?php

namespace App\Services;

use App\Models\AddressArea;
use App\Models\Product;
use App\Models\ProductAddOn;
use App\Models\ProductVariant;

class InvoiceService
{
    /**
     * @param mixed|string $addressAreaId
     */
    public static function copyAddressAreaData($addressAreaId): array
    {
        if (!$addressAreaId) {
            return [];
        }

        $area = AddressArea::find($addressAreaId);

        return  [
            'id' => $area->id,
            'province' => $area->province,
            'city' => $area->city,
            'district' => $area->district,
            'urban' => $area->urban,
            'postal_code' => $area->postal_code,
            'small_price' => $area->small_price ?? 0,
            'medium_price' => $area->medium_price ?? 0,
        ];
    }

    public static function generateProductsDetail(array $productsInRequest): array
    {
        $detail = [];
        foreach ($productsInRequest as $p) {
            $product = Product::findOrFail($p['id']);
            $thumbnail = $product->productImages()->first();
            $total_price = 0;

            $chosenSize = collect($product->sizes)->where('name', $p['size'])->first();

            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'size' => $chosenSize,
                'message' => $p['message'],
                'thumbnail_image' => $thumbnail->thumbnail_image,
                'price' => $chosenSize['price'],
                'variant' => [],
                'add_ons' => [],
                'total_price'  => 0,
            ];

            $total_price += $item['price'];

            if ($p['variant_id']) {
                $variant = ProductVariant::findOrFail($p['variant_id']);

                $item['variant'] = [
                    'id' => $variant->id,
                    'name' => $variant->name,
                    'price' => $variant->price,
                    'thumbnail_image' => $variant->thumbnail_image
                ];

                $total_price += $variant->price;
            }

            if (count($p['add_ons']) > 0) {
                foreach ($p['add_ons'] as $ao) {
                    if ($ao['id']) {

                        $addOn = ProductAddOn::findOrFail($ao['id']);

                        array_push(
                            $item['add_ons'],
                            [
                                'id' => $addOn['id'],
                                'name' => $addOn['name'],
                                'price' => $addOn['price'],
                                'thumbnail_image' => $addOn->thumbnail_image
                            ]
                        );

                        $total_price += $addOn->price;
                    }
                }
            }

            $item['total_price'] = $total_price;

            array_push($detail, $item);
        }

        return $detail;
    }

    public static function defineDeliverFee(array $productsDetail, array $addressArea): int
    {
        $sizes = [];

        foreach ($productsDetail as $p) {
            array_push($sizes, $p['size']);
        }

        if (count($sizes) > 1) {
            return $addressArea['medium_price'];
        }

        if (count($sizes) == 1 && $sizes[0] == 'M') {
            return $addressArea['medium_price'];
        }

        return $addressArea['small_price'];
    }

    public static function calculateGrandTotal(array $productsDetail, int $deliveryFee): int
    {
        $total = 0;

        foreach ($productsDetail as $p) {
            $total += $p['total_price'];
        }

        return $total + $deliveryFee;
    }
}
