<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Product::distinct('category')->count('category');
        $avgPrice = Product::avg('price');
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'avgPrice',
            'recentProducts'
        ));
    }

    // Products Index
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Create
    public function create()
    {
        return view('admin.products.create');
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully!');
    }

    // Edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    // Delete
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}