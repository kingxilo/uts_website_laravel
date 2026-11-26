@extends('layouts.app')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Katalog Produk')

@section('content')
    <!-- Clean Page Header -->
    <section class="border-b border-stone-200/80 bg-stone-50/70">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="mb-3 flex items-center gap-2 text-xs font-medium text-stone-500">
                <a href="{{ route('home') }}" class="hover:text-amber-700 hover:underline">Beranda</a>
                <span aria-hidden="true">/</span>
                <span class="font-semibold text-stone-900">Katalog Produk</span>
                @if ($activeCategory)
                    <span aria-hidden="true">/</span>
                    <span class="font-semibold text-amber-700">{{ $activeCategory->name }}</span>
                @endif
            </nav>

            <div class="max-w-2xl">
                <h1 class="text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">
                    {{ $activeCategory ? $activeCategory->name : 'Katalog Produk Kopi Nusantara' }}
                </h1>
                <p class="mt-2 text-sm leading-relaxed text-stone-600 sm:text-base">
                    {{ $activeCategory?->description ?? 'Temukan biji kopi single origin, kopi bubuk artisan, minuman cold brew, dan paket hampers dari PT Surya Rasa Nusantara.' }}
                </p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <!-- Search, Sort & Category Filter Card -->
        <div class="rounded-2xl border border-stone-200/80 bg-white p-4 shadow-2xs sm:p-5">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                @if ($activeCategorySlug)
                    <input type="hidden" name="kategori" value="{{ $activeCategorySlug }}">
                @endif

                <div class="relative flex-1">
                    <label for="catalog-search" class="sr-only">Cari nama kopi atau daerah asal</label>
                    <svg aria-hidden="true" class="pointer-events-none absolute left-3.5 top-3 h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input
                        id="catalog-search"
                        type="search"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Cari Aceh Gayo, Toraja, Gula Aren, atau Hampers..."
                        class="min-h-[42px] w-full rounded-xl border border-stone-200 bg-stone-50/60 py-2 pl-10 pr-4 text-sm text-stone-900 placeholder:text-stone-400 focus:border-amber-600 focus:bg-white"
                    >
                </div>

                <div class="flex items-center gap-2.5">
                    <label for="catalog-sort" class="shrink-0 text-xs font-semibold text-stone-500">Urutkan:</label>
                    <select
                        id="catalog-sort"
                        name="urut"
                        onchange="this.form.submit()"
                        class="min-h-[42px] flex-1 rounded-xl border border-stone-200 bg-white px-3.5 py-2 text-sm font-semibold text-stone-800 sm:flex-none"
                    >
                        <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                        <option value="harga_asc" @selected($sort === 'harga_asc')>Harga Terendah</option>
                        <option value="harga_desc" @selected($sort === 'harga_desc')>Harga Tertinggi</option>
                        <option value="nama" @selected($sort === 'nama')>Nama (A–Z)</option>
                    </select>

                    <button
                        type="submit"
                        class="min-h-[42px] shrink-0 rounded-xl bg-stone-900 px-5 py-2 text-sm font-bold text-white transition-colors hover:bg-amber-700"
                    >
                        Cari
                    </button>
                </div>
            </form>

            <!-- Category Filter Pills -->
            <div class="mt-4 border-t border-stone-100 pt-4">
                <div class="flex items-center gap-2 overflow-x-auto pb-1" role="navigation" aria-label="Filter Kategori">
                    <a
                        href="{{ route('products.index', array_filter(['q' => $search, 'urut' => $sort !== 'terbaru' ? $sort : null])) }}"
                        @if (! $activeCategorySlug) aria-current="true" @endif
                        class="shrink-0 rounded-full px-4 py-2 text-xs font-bold transition-colors {{ ! $activeCategorySlug ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}"
                    >
                        Semua Kategori
                    </a>
                    @foreach ($categories as $category)
                        <a
                            href="{{ route('products.index', array_filter(['kategori' => $category->slug, 'q' => $search, 'urut' => $sort !== 'terbaru' ? $sort : null])) }}"
                            @if ($activeCategorySlug === $category->slug) aria-current="true" @endif
                            class="shrink-0 rounded-full px-4 py-2 text-xs font-bold transition-colors {{ $activeCategorySlug === $category->slug ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}"
                        >
                            <span>{{ $category->name }}</span>
                            <span class="ml-1 opacity-75">({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Result Count Bar -->
        <div class="mt-6 flex flex-wrap items-center justify-between gap-3 text-sm text-stone-600" aria-live="polite">
            <p>
                Menampilkan <strong class="font-bold text-stone-900">{{ $products->count() }}</strong> dari <strong class="font-bold text-stone-900">{{ $products->total() }}</strong> produk
                @if ($search !== '')
                    untuk pencarian <span class="rounded-md bg-amber-50 px-2 py-0.5 font-semibold text-amber-900">"{{ $search }}"</span>
                @endif
            </p>

            @if ($search !== '' || $activeCategorySlug || $sort !== 'terbaru')
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-1 text-xs font-bold text-amber-700 hover:underline"
                >
                    <span>Reset Filter</span>
                    <span aria-hidden="true">&times;</span>
                </a>
            @endif
        </div>

        <!-- Product Grid -->
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full rounded-2xl border border-stone-200 bg-stone-50/50 px-6 py-16 text-center">
                    <h2 class="text-xl font-bold text-stone-900">Produk tidak ditemukan</h2>
                    <p class="mx-auto mt-1.5 max-w-md text-sm text-stone-600">
                        Belum ada produk yang sesuai dengan kata kunci atau kategori yang dipilih.
                    </p>
                    <a
                        href="{{ route('products.index') }}"
                        class="mt-5 inline-flex min-h-[42px] items-center rounded-xl bg-stone-900 px-5 py-2.5 text-xs font-bold text-white transition-colors hover:bg-amber-700"
                    >
                        Tampilkan Semua Produk
                    </a>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </section>
@endsection
