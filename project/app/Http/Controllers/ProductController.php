<?php

namespace App\Http\Controllers;

use project\app\Action\Product\StoreProductAction;
use project\app\Action\Product\UpdateProductAction;
use project\app\DataTransferObject\Product\StoreProductData;
use project\app\DataTransferObject\Product\UpdateProductData;
use project\app\Http\Controllers\Controller;use project\app\Models\Product;
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
