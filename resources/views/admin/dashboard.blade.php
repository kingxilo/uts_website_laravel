@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Dashboard Admin')
@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Stat Cards -->
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs">
            <p class="text-xs font-bold text-stone-500">Total Produk</p>
            <p class="mt-2 text-3xl font-extrabold text-stone-900 tabular-nums">{{ $stats['total_products'] }}</p>
            <a href="{{ route('admin.products.index') }}" class="mt-3 inline-block text-xs font-bold text-amber-700 hover:underline">Kelola produk &rarr;</a>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs">
            <p class="text-xs font-bold text-stone-500">Total Kategori</p>
            <p class="mt-2 text-3xl font-extrabold text-stone-900 tabular-nums">{{ $stats['total_categories'] }}</p>
            <a href="{{ route('admin.categories.index') }}" class="mt-3 inline-block text-xs font-bold text-amber-700 hover:underline">Kelola kategori &rarr;</a>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs">
            <p class="text-xs font-bold text-stone-500">Total Stok Gudang</p>
            <p class="mt-2 text-3xl font-extrabold text-stone-900 tabular-nums">{{ number_format($stats['total_stock'], 0, ',', '.') }}</p>
            <p class="mt-3 text-xs text-stone-500">Unit siap dikirim</p>
        </div>

        <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs">
            <p class="text-xs font-bold text-stone-500">Produk Unggulan</p>
            <p class="mt-2 text-3xl font-extrabold text-amber-700 tabular-nums">{{ $stats['featured_count'] }}</p>
            <p class="mt-3 text-xs text-stone-500">Tampil di halaman beranda</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-12">
        <!-- Recent Products -->
        <div class="rounded-2xl border border-stone-200/80 bg-white p-6 shadow-2xs lg:col-span-8">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-extrabold text-stone-900">Produk Terbaru</h2>
                    <p class="text-xs text-stone-500">5 produk terakhir di database.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-amber-700 hover:underline">Lihat semua &rarr;</a>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="w-full min-w-[520px] text-left text-sm">
                    <thead class="border-b border-stone-200 text-xs font-bold text-stone-500">
                        <tr>
                            <th class="py-3 pr-4">Produk</th>
                            <th class="py-3 pr-4">Kategori</th>
                            <th class="py-3 pr-4">Harga</th>
                            <th class="py-3 pr-4">Stok</th>
                            <th class="py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse ($recentProducts as $product)
                            <tr class="hover:bg-stone-50/80">
                                <td class="py-3 pr-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-11 w-11 shrink-0 rounded-xl border border-stone-200 object-cover">
                                        <span class="font-bold text-stone-900">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 pr-4 text-xs text-stone-600">{{ $product->category?->name ?? '-' }}</td>
                                <td class="py-3 pr-4 text-xs font-bold text-stone-900 tabular-nums">{{ $product->formatted_price }}</td>
                                <td class="py-3 pr-4 text-xs font-semibold tabular-nums">{{ $product->stock }}</td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-stone-100 px-3 py-1.5 text-xs font-bold text-stone-800 hover:bg-stone-200">Ubah</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-stone-500">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="rounded-2xl border border-stone-200/80 bg-white p-6 shadow-2xs lg:col-span-4">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-base font-extrabold text-stone-900">Ringkasan Kategori</h2>
                <a href="{{ route('admin.categories.create') }}" class="text-xs font-bold text-amber-700 hover:underline">+ Tambah</a>
            </div>

            @php
                $maxCatCount = max(1, (int) $categories->max('products_count'));
            @endphp
            <ul class="mt-5 space-y-4">
                @foreach ($categories as $category)
                    <li>
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-stone-800">{{ $category->name }}</span>
                            <span class="font-semibold text-stone-500 tabular-nums">{{ $category->products_count }} produk</span>
                        </div>
                        <div class="mt-1.5 h-2 w-full overflow-hidden rounded-full bg-stone-100">
                            <div
                                class="h-full rounded-full bg-amber-600"
                                style="width: {{ round(($category->products_count / $maxCatCount) * 100) }}%"
                            ></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
