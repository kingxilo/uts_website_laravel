<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $activeCategorySlug = $request->query('kategori');
        $search = trim((string) $request->query('q', ''));
        $sort = $request->query('urut', 'terbaru');

        $query = Product::with('category');

        if ($activeCategorySlug) {
            $query->whereHas('category', function ($q) use ($activeCategorySlug) {
                $q->where('slug', $activeCategorySlug);
            });
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('origin', 'like', "%{$search}%");
            });
        }

        match ($sort) {
            'harga_asc' => $query->orderBy('price', 'asc'),
            'harga_desc' => $query->orderBy('price', 'desc'),
            'nama' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();
        $activeCategory = $activeCategorySlug
            ? $categories->firstWhere('slug', $activeCategorySlug)
            : null;

        return view('public.products.index', compact(
            'products',
            'categories',
            'activeCategory',
            'activeCategorySlug',
            'search',
            'sort'
        ));
    }

    public function show(Product $product): View
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedProducts->count() < 3) {
            $extra = Product::with('category')
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->latest()
                ->take(3 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->concat($extra);
        }

        return view('public.products.show', compact('product', 'relatedProducts'));
    }
}
