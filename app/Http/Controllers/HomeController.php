<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the homepage with featured products.
     */
    public function index()
    {
        // Get the 6 most recent products to display as featured
        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}
