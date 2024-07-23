<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        return response()->json([
            'status' => 'true',
            'products' => ProductResource::collection($products),
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'status' => 'true',
            'products' => new ProductDetailResource($product),
        ]);
    }
}
