<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function search($query)
    {
        $products = Product::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('category', 'LIKE', "%{$query}%")
                          ->get();
        return response()->json($products);
    }
}