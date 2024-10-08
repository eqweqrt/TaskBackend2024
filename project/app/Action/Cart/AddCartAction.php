<?php

namespace App\Action\Cart;

use project\app\Models\Cart;
use project\app\Models\Product;

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
