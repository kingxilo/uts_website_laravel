@extends('layouts.app')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | ' . $product->name)

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-6 flex flex-wrap items-center gap-2 text-xs font-medium text-stone-500">
            <a href="{{ route('home') }}" class="hover:text-amber-700 hover:underline">Beranda</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-amber-700 hover:underline">Katalog Produk</a>
            @if ($product->category)
                <span aria-hidden="true">/</span>
                <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-amber-700 hover:underline">
                    {{ $product->category->name }}
                </a>
            @endif
            <span aria-hidden="true">/</span>
            <span class="font-semibold text-stone-900">{{ $product->name }}</span>
        </nav>

        <!-- Clean White Product Detail Card -->
        <div class="grid gap-8 rounded-3xl border border-stone-200/80 bg-white p-5 shadow-xs sm:p-8 lg:grid-cols-12 lg:gap-12">
            <!-- Left: Product Photo -->
            <div class="lg:col-span-5">
                <div class="relative overflow-hidden rounded-2xl border border-stone-200/70 bg-stone-100 aspect-square">
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover"
                    >
                    @if ($product->is_featured)
                        <span class="absolute left-3.5 top-3.5 rounded-full bg-amber-500 px-3 py-1 text-xs font-bold text-white shadow-xs">
                            Produk Unggulan
                        </span>
                    @endif
                </div>

                <div class="mt-4 grid grid-cols-3 gap-2.5 text-center text-xs">
                    <div class="rounded-xl border border-stone-200/80 bg-stone-50 px-2 py-2.5">
                        <span class="block font-bold text-stone-900">Fresh Roast</span>
                        <span class="text-[11px] text-stone-500">Sangrai Segar</span>
                    </div>
                    <div class="rounded-xl border border-stone-200/80 bg-stone-50 px-2 py-2.5">
                        <span class="block font-bold text-stone-900">100% Murni</span>
                        <span class="text-[11px] text-stone-500">Biji Pilihan</span>
                    </div>
                    <div class="rounded-xl border border-stone-200/80 bg-stone-50 px-2 py-2.5">
                        <span class="block font-bold text-stone-900">Valve Pack</span>
                        <span class="text-[11px] text-stone-500">Kemasan Kedap</span>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info & Order Box -->
            <div class="flex flex-col lg:col-span-7">
                <div class="flex flex-wrap items-center gap-2">
                    @if ($product->category)
                        <a
                            href="{{ route('products.index', ['kategori' => $product->category->slug]) }}"
                            class="rounded-full bg-amber-50 px-3.5 py-1 text-xs font-bold text-amber-800 transition-colors hover:bg-amber-100"
                        >
                            {{ $product->category->name }}
                        </a>
                    @endif

                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        {{ $product->stock > 0 ? 'Stok Tersedia (' . $product->stock . ')' : 'Stok Habis' }}
                    </span>
                </div>

                <h1 class="mt-3 text-2xl font-extrabold leading-tight text-stone-900 sm:text-3xl lg:text-4xl">
                    {{ $product->name }}
                </h1>

                <p class="mt-3 text-2xl font-extrabold text-amber-700 tabular-nums sm:text-3xl">
                    {{ $product->formatted_price }}
                </p>

                <!-- Clean 3-Card Spec Row -->
                <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3">
                    <div class="rounded-xl border border-stone-200/80 bg-stone-50/70 p-3.5">
                        <p class="text-xs font-medium text-stone-500">Berat / Volume</p>
                        <p class="mt-0.5 text-sm font-bold text-stone-900 tabular-nums">{{ $product->weight_gram }} gram/ml</p>
                    </div>
                    <div class="rounded-xl border border-stone-200/80 bg-stone-50/70 p-3.5">
                        <p class="text-xs font-medium text-stone-500">Tingkat Sangrai</p>
                        <p class="mt-0.5 text-sm font-bold text-stone-900">{{ $product->roast_level ?: 'Standar Roastery' }}</p>
                    </div>
                    <div class="col-span-2 rounded-xl border border-stone-200/80 bg-stone-50/70 p-3.5 sm:col-span-1">
                        <p class="text-xs font-medium text-stone-500">Daerah Asal / Racikan</p>
                        <p class="mt-0.5 truncate text-sm font-bold text-stone-900" title="{{ $product->origin }}">{{ $product->origin ?: 'Nusantara' }}</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6 border-t border-stone-100 pt-5">
                    <h2 class="text-sm font-bold text-stone-900">Deskripsi Produk</h2>
                    <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-stone-600 sm:text-base">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Order Configurator -->
                <div class="mt-6 rounded-2xl border border-stone-200/90 bg-stone-50/70 p-4 sm:p-5">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="order-grind" class="block text-xs font-bold text-stone-700">Pilihan Gilingan / Sajian</label>
                            <select
                                id="order-grind"
                                class="mt-1.5 min-h-[42px] w-full rounded-xl border border-stone-200 bg-white px-3 py-2 text-sm font-medium text-stone-900"
                            >
                                <option value="Sesuai Standar Produk">Sesuai Standar Produk</option>
                                <option value="Biji Utuh (Whole Bean)">Biji Utuh (Whole Bean)</option>
                                <option value="Giling Sedang (V60 / Pour Over)">Giling Sedang (V60 / Pour Over)</option>
                                <option value="Giling Kasar (French Press / Cold Brew)">Giling Kasar (French Press)</option>
                                <option value="Giling Halus (Kopi Tubruk / Espresso)">Giling Halus (Tubruk / Espresso)</option>
                            </select>
                        </div>

                        <div>
                            <label for="order-qty" class="block text-xs font-bold text-stone-700">Jumlah Kemasan</label>
                            <div class="mt-1.5 flex items-center">
                                <button
                                    type="button"
                                    id="qty-minus"
                                    aria-label="Kurangi jumlah"
                                    class="inline-flex h-[42px] w-11 items-center justify-center rounded-l-xl border border-stone-200 bg-white text-base font-bold text-stone-800 hover:bg-stone-100"
                                >&minus;</button>
                                <input
                                    id="order-qty"
                                    type="number"
                                    min="1"
                                    max="{{ max(1, $product->stock) }}"
                                    value="1"
                                    class="h-[42px] w-full border-y border-stone-200 bg-white text-center text-sm font-bold text-stone-900 tabular-nums"
                                >
                                <button
                                    type="button"
                                    id="qty-plus"
                                    aria-label="Tambah jumlah"
                                    class="inline-flex h-[42px] w-11 items-center justify-center rounded-r-xl border border-stone-200 bg-white text-base font-bold text-stone-800 hover:bg-stone-100"
                                >+</button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-stone-200/70 pt-3 text-sm">
                        <span class="font-medium text-stone-600">Estimasi Total Harga</span>
                        <strong id="order-subtotal" class="text-lg font-extrabold text-stone-900 tabular-nums">
                            {{ $product->formatted_price }}
                        </strong>
                    </div>

                    @php
                        $defaultWa = "Halo Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara), saya ingin memesan:\n- Produk: {$product->name}\n- Jumlah: 1\n- Pilihan: Sesuai Standar Produk\nApakah stok tersedia?";
                    @endphp
                    <div class="mt-4 flex flex-col gap-2.5 sm:flex-row">
                        <a
                            id="wa-order-link"
                            href="https://wa.me/6281234567890?text={{ urlencode($defaultWa) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex min-h-[46px] flex-1 items-center justify-center gap-2 rounded-xl bg-stone-900 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-amber-700"
                        >
                            <span>Pesan Sekarang via WhatsApp</span>
                            <svg aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex min-h-[46px] items-center justify-center rounded-xl border border-stone-200 bg-white px-5 py-3 text-sm font-bold text-stone-700 transition-colors hover:border-stone-900 hover:text-stone-900"
                        >
                            &larr; Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if ($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Rekomendasi</span>
                        <h2 class="mt-1 text-2xl font-extrabold text-stone-900">Produk Lainnya yang Mungkin Anda Suka</h2>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-sm font-bold text-amber-700 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const unitPrice = {{ (int) $product->price }};
            const maxStock = {{ max(1, (int) $product->stock) }};
            const productName = @json($product->name);

            const qtyInput = document.getElementById('order-qty');
            const minusBtn = document.getElementById('qty-minus');
            const plusBtn = document.getElementById('qty-plus');
            const grindSelect = document.getElementById('order-grind');
            const subtotalEl = document.getElementById('order-subtotal');
            const waLink = document.getElementById('wa-order-link');

            const formatRupiah = (num) => 'Rp ' + new Intl.NumberFormat('id-ID').format(num);

            const syncOrder = () => {
                let qty = parseInt(qtyInput.value || '1', 10);
                if (Number.isNaN(qty) || qty < 1) qty = 1;
                if (qty > maxStock) qty = maxStock;
                qtyInput.value = qty;

                const subtotal = unitPrice * qty;
                subtotalEl.textContent = formatRupiah(subtotal);

                const grind = grindSelect.value;
                const message = `Halo Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara), saya ingin memesan:\n- Produk: ${productName}\n- Jumlah: ${qty} kemasan\n- Pilihan: ${grind}\n- Estimasi Total: ${formatRupiah(subtotal)}\nApakah stok tersedia?`;
                waLink.href = 'https://wa.me/6281234567890?text=' + encodeURIComponent(message);
            };

            minusBtn?.addEventListener('click', () => {
                qtyInput.value = Math.max(1, parseInt(qtyInput.value || '1', 10) - 1);
                syncOrder();
            });
            plusBtn?.addEventListener('click', () => {
                qtyInput.value = Math.min(maxStock, parseInt(qtyInput.value || '1', 10) + 1);
                syncOrder();
            });
            qtyInput?.addEventListener('input', syncOrder);
            grindSelect?.addEventListener('change', syncOrder);
        });
    </script>
    @endpush
@endsection
