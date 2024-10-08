<?php

namespace App\Action\Product;

use project\app\DataTransferObject\Product\UpdateProductData;
use project\app\Models\Product;

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
