<?php

namespace project\app\Http\Controllers;

use project\app\Action\Cart\AddCartAction;
use project\app\Http\Controllers\Controller;use project\app\Models\Cart;
use project\app\Models\CartHistory;
use project\app\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $carts = Cart::query()->where('user_id', auth()->id())->get();
        $response = $carts->map(function (Cart $cart) {
            $product = Product::query()->find($cart->product_id);
            return [
                'id' => $cart->id,
                'product_id' => $cart->product_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
            ];
        });
        return response()->json($response);
    }

    public function add(Product $product): JsonResponse
    {
        $cart = AddCartAction::execute($product);
        return response()->json(['message' => 'Product add to cart'], 201);
    }

    public function remove(Cart $cart): JsonResponse
    {
        throw_if(auth()->id() != $cart->user_id, new HttpResponseException(response()->json(['message' => 'Forbidden for you'], 403)));

        $cart->delete();

        return response()->json(['message' => 'Item removed from cart'], 200);
    }

    public function purchase()
    {
        throw_if(Cart::query()->where('user_id', '=', auth()->id())->count() == 0, new HttpResponseException(response()->json(['message' => 'Cart is empty'])));

        $carts = Cart::query()
            ->where('user_id', '=', auth()->id())
            ->get();

        $totalPrice = 0;

        $carts->each(function (Cart $cart) use (&$totalPrice) {
            $product = Product::query()->find($cart->product_id);
            $totalPrice += $product->price;
        });

        $productsInCart = Cart::query()
            ->where('user_id', '=', auth()->id())
            ->pluck('product_id')
            ->toArray();

        Cart::query()
            ->where('user_id', auth()->id())
            ->delete();

        $cartHistory = new CartHistory([
            'user_id' => auth()->id(),
            'products' => json_encode($productsInCart),
            'price' => $totalPrice
        ]);

        $cartHistory->save();

        return response()->json(['order_id' => $cartHistory->id, 'message' => 'Order processed'], 201);
    }

    public function order(): JsonResponse
    {
        $cartHistory = CartHistory::query()->where('user_id', '=', auth()->id())->get();
        $response = $cartHistory->map(function (CartHistory $cartHistory) {
            return [
                'id' => $cartHistory->id,
                'products' => $cartHistory->products,
                'price' => $cartHistory->price
            ];
        });
        return response()->json($response);
    }

}
