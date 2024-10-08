<?php

namespace App\Action\Product;

use App\DataTransferObject\Product\StoreProductData;
use App\Models\Product;

class StoreProductAction
{
    public static function execute(StoreProductData $data): Product
    {
        $product = new Product([
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price
        ]);
        $product->save();

        return $product;
    }
}
