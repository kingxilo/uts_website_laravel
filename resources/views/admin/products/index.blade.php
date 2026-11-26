@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Kelola Produk')
@section('page_title', 'Kelola Produk')

@section('content')
    <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-extrabold text-stone-900">Daftar Produk UMKM</h2>
                <p class="mt-0.5 text-xs text-stone-500">Tambah, ubah detail, unggah foto baru, atau hapus produk dari katalog.</p>
            </div>
            <a
                href="{{ route('admin.products.create') }}"
                class="inline-flex min-h-[42px] items-center justify-center gap-2 rounded-xl bg-stone-900 px-4 py-2 text-xs font-bold text-white transition-colors hover:bg-amber-700 sm:text-sm"
            >
                + Tambah Produk Baru
            </a>
        </div>

        <!-- Filter & Search -->
        <form action="{{ route('admin.products.index') }}" method="GET" class="mt-5 flex flex-col gap-2.5 sm:flex-row">
            <label for="admin-q" class="sr-only">Cari produk</label>
            <input
                id="admin-q"
                type="search"
                name="q"
                value="{{ $search }}"
                placeholder="Cari nama produk atau daerah asal..."
                class="min-h-[40px] flex-1 rounded-xl border border-stone-200 bg-stone-50/50 px-3.5 py-2 text-sm focus:border-amber-600 focus:bg-white"
            >
            <label for="admin-cat" class="sr-only">Filter kategori</label>
            <select
                id="admin-cat"
                name="category_id"
                class="min-h-[40px] rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-sm font-medium sm:w-56"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="min-h-[40px] rounded-xl bg-amber-600 px-5 py-2 text-xs font-bold text-white transition-colors hover:bg-amber-700 sm:text-sm">
                Filter
            </button>
            @if ($search !== '' || $categoryId)
                <a href="{{ route('admin.products.index') }}" class="inline-flex min-h-[40px] items-center justify-center rounded-xl border border-stone-200 px-4 py-2 text-xs font-bold text-stone-700 hover:bg-stone-50">
                    Reset
                </a>
            @endif
        </form>

        <!-- Data Table -->
        <div class="mt-6 overflow-x-auto">
            <table class="w-full min-w-[740px] text-left text-sm">
                <thead class="border-y border-stone-200 bg-stone-50 text-xs font-bold text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-stone-50/70">
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3.5">
                                    <img
                                        src="{{ $product->image_url }}"
                                        alt="{{ $product->name }}"
                                        class="h-12 w-12 shrink-0 rounded-xl border border-stone-200 object-cover"
                                    >
                                    <div>
                                        <p class="font-bold text-stone-900">{{ $product->name }}</p>
                                        <p class="mt-0.5 text-xs text-stone-500">
                                            {{ $product->weight_gram }}g/ml &bull; {{ $product->roast_level ?: 'Standar' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-700">
                                    {{ $product->category?->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 font-bold text-stone-900 tabular-nums">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="px-4 py-3.5 text-xs font-bold tabular-nums">
                                @if ($product->stock <= 0)
                                    <span class="text-rose-600">0 (Habis)</span>
                                @elseif ($product->stock <= 5)
                                    <span class="text-amber-700">{{ $product->stock }} (Menipis)</span>
                                @else
                                    <span class="text-emerald-700">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5">
                                @if ($product->is_featured)
                                    <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-800">Unggulan</span>
                                @else
                                    <span class="rounded-full bg-stone-100 px-2.5 py-1 text-xs font-medium text-stone-600">Reguler</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        target="_blank"
                                        class="inline-flex min-h-[34px] items-center rounded-lg border border-stone-200 bg-white px-2.5 py-1 text-xs font-bold text-stone-700 hover:bg-stone-50"
                                    >
                                        Lihat
                                    </a>
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="inline-flex min-h-[34px] items-center rounded-lg bg-stone-100 px-3 py-1 text-xs font-bold text-stone-800 hover:bg-stone-200"
                                    >
                                        Ubah
                                    </a>
                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        data-confirm-delete="Hapus produk &ldquo;{{ $product->name }}&rdquo; beserta file fotonya dari storage?"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex min-h-[34px] items-center rounded-lg bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700 transition-colors hover:bg-rose-600 hover:text-white"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-sm text-stone-500">
                                Tidak ada produk yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
