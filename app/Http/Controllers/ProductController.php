<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Product listing with search & category filter.
     */
    public function index()
    {
        $categories = Category::all();

        // Build query
        $query = Product::with('category');

        // Filter by category if selected
        if (request('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', request('category')));
        }

        // Search by product name
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show a single product by its slug.
     */
    public function show($slug)
    {
        // Find product by slug or show 404
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }
}
