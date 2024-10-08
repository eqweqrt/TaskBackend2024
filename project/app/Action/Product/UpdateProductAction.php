<?php

namespace App\Action\Product;

use App\DataTransferObject\Product\UpdateProductData;
use App\Models\Product;

class UpdateProductAction
{
    public static function execute(Product $product, UpdateProductData $data): Product
    {
        $product->update([
            'description' => $data->description,
        ]);

        $product->refresh();

        return $product;
    }
}
