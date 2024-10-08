<?php

namespace App\Action\Cart;

use App\Models\Cart;
use App\Models\Product;

class AddCartAction
{
    public static function execute(Product $product): Cart
    {
        $cart = new Cart([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);
        $cart->save();

        return $cart;
    }
}
