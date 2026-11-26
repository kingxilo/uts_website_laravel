<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')
                ->latest()
                ->take(4)
                ->get();
        }

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_stock' => Product::sum('stock'),
        ];

        return view('public.home', compact('featuredProducts', 'categories', 'stats'));
    }
}
