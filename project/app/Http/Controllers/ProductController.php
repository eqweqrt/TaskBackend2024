<?php

namespace App\Http\Controllers;

use App\Action\Product\StoreProductAction;
use App\Action\Product\UpdateProductAction;
use App\DataTransferObject\Product\StoreProductData;
use App\DataTransferObject\Product\UpdateProductData;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Product::all());
    }

    public function store(StoreProductData $data): JsonResponse
    {
        throw_unless(auth()->user()->hasRole('admin'), new HttpResponseException(response()->json(['message' => 'Permission denied'], 403)));

        $product = StoreProductAction::execute($data);

        return response()->json(['id' => $product->id, 'message' => 'Product added'], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    public function update(Product $product, UpdateProductData $data): JsonResponse
    {
        throw_unless(auth()->user()->hasRole('admin'), new HttpResponseException(response()->json(['message' => 'Permission denied'], 403)));

        $product = UpdateProductAction::execute($product, $data);
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price
        ], 200);
    }

    public function delete(Product $product): JsonResponse
    {
        throw_unless(auth()->user()->hasRole('admin'), new HttpResponseException(response()->json(['message' => 'Permission denied'], 403)));

        $product->delete();
        return response()->json(['message' => 'Product removed'], 200);
    }
}
