<?php

namespace project\app\Action\Product;

use project\app\DataTransferObject\Product\StoreProductData;
use project\app\Models\Product;

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
