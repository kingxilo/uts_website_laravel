<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_stock' => Product::sum('stock'),
            'featured_count' => Product::where('is_featured', true)->count(),
        ];

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProducts', 'categories'));
    }
}
