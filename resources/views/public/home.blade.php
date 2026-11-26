@extends('layouts.app')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | PT Surya Rasa Nusantara')

@section('content')
    <!-- Clean, Modern Split Hero Section -->
    <section class="relative overflow-hidden border-b border-stone-200/70 bg-gradient-to-b from-stone-50 via-amber-50/25 to-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-20">
            <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-12">
                <!-- Left Copy (7 cols) -->
                <div class="lg:col-span-7">
                    <div class="inline-flex flex-wrap items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3.5 py-1.5 text-xs font-bold text-amber-900">
                        <span>Susilo Apriyansah - Surya Nusantara Kopi</span>
                        <span class="h-1 w-1 rounded-full bg-amber-600"></span>
                        <span>PT Surya Rasa Nusantara</span>
                    </div>

                    <h1 class="mt-5 text-4xl font-extrabold leading-[1.12] tracking-tight text-stone-900 sm:text-5xl lg:text-[3.25rem]">
                        Cita Rasa Kopi Terbaik Nusantara, <span class="text-amber-700">Disangrai Segar</span> Setiap Pekan.
                    </h1>

                    <p class="mt-5 max-w-xl text-base leading-relaxed text-stone-600 sm:text-lg">
                        <strong class="font-semibold text-stone-900">PT Surya Rasa Nusantara</strong> menghadirkan biji kopi petik merah pilihan dari petani lokal Aceh Gayo, Toraja, Kintamani, hingga Lampung. Diproses secara <em>small-batch roasting</em> untuk menjaga kesegaran aroma di setiap seduhan Anda.
                    </p>

                    <!-- CTAs -->
                    <div class="mt-8 flex flex-wrap items-center gap-3.5">
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex min-h-[48px] items-center gap-2.5 rounded-xl bg-stone-900 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition-all hover:bg-amber-700"
                        >
                            <span>Jelajahi Katalog Produk</span>
                            <svg aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a
                            href="#tentang-usaha"
                            class="inline-flex min-h-[48px] items-center rounded-xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-bold text-stone-800 shadow-2xs transition-colors hover:border-stone-900 hover:bg-stone-50"
                        >
                            Profil PT Surya Rasa Nusantara
                        </a>
                    </div>

                    <!-- Trust & Live Metric Cards -->
                    <div class="mt-10 grid max-w-xl grid-cols-3 gap-3 sm:gap-4">
                        <div class="rounded-2xl border border-stone-200/80 bg-white p-4 shadow-2xs">
                            <p class="text-2xl font-extrabold text-stone-900 tabular-nums sm:text-3xl">{{ $stats['total_products'] }}+</p>
                            <p class="mt-0.5 text-xs font-medium text-stone-500">Varian Kopi &amp; Hampers</p>
                        </div>
                        <div class="rounded-2xl border border-stone-200/80 bg-white p-4 shadow-2xs">
                            <p class="text-2xl font-extrabold text-stone-900 tabular-nums sm:text-3xl">{{ $stats['total_categories'] }}</p>
                            <p class="mt-0.5 text-xs font-medium text-stone-500">Kategori Produk</p>
                        </div>
                        <div class="rounded-2xl border border-stone-200/80 bg-white p-4 shadow-2xs">
                            <p class="text-2xl font-extrabold text-amber-700 tabular-nums sm:text-3xl">{{ number_format($stats['total_stock'], 0, ',', '.') }}</p>
                            <p class="mt-0.5 text-xs font-medium text-stone-500">Stok Siap Kirim</p>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Image Card (5 cols) -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                        <div class="overflow-hidden rounded-3xl border border-stone-200/80 bg-white p-2.5 shadow-xl shadow-stone-900/5">
                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3] lg:aspect-[4/4.2]">
                                <img
                                    src="{{ asset('images/hero-coffee.jpg') }}"
                                    alt="Roastery Surya Nusantara Kopi - PT Surya Rasa Nusantara"
                                    class="h-full w-full object-cover"
                                >
                                <div class="absolute inset-x-3 bottom-3 rounded-2xl border border-white/20 bg-stone-950/80 p-4 text-white backdrop-blur-md">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-bold text-amber-400">100% Biji Kopi Nusantara</span>
                                        <span class="rounded-full bg-emerald-500/20 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-300">Fresh Roast</span>
                                    </div>
                                    <p class="mt-1 text-xs text-stone-200">
                                        Disangrai langsung di Roastery Bandar Lampung dari biji pilihan Gayo, Toraja, Kintamani &amp; Lampung.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Produk Section -->
    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Kategori Katalog</span>
                <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-stone-900 sm:text-3xl">
                    Pilih Produk Sesuai Selera Seduhan
                </h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-bold text-amber-700 hover:text-amber-800 hover:underline">
                Lihat Semua Kategori &rarr;
            </a>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($categories as $category)
                <a
                    href="{{ route('products.index', ['kategori' => $category->slug]) }}"
                    class="group flex flex-col justify-between rounded-2xl border border-stone-200/80 bg-white p-6 shadow-[0_2px_10px_-3px_rgba(28,25,23,0.05)] transition-all duration-200 hover:-translate-y-1 hover:border-amber-500/50 hover:shadow-lg"
                >
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-700 transition-colors group-hover:bg-amber-600 group-hover:text-white">
                                <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                            </span>
                            <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-bold text-stone-700 tabular-nums">
                                {{ $category->products_count }} Produk
                            </span>
                        </div>

                        <h3 class="mt-4 text-lg font-bold text-stone-900 transition-colors group-hover:text-amber-700">
                            {{ $category->name }}
                        </h3>

                        <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-stone-600 sm:text-sm">
                            {{ $category->description }}
                        </p>
                    </div>

                    <span class="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-amber-700">
                        <span>Jelajahi Kategori</span>
                        <svg aria-hidden="true" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Produk Unggulan Section (On Soft Stone Surface so White Cards Pop) -->
    <section class="border-y border-stone-200/80 bg-stone-50/80 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Produk Unggulan</span>
                    <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-stone-900 sm:text-3xl">
                        Kopi Terfavorit Pilihan Pelanggan
                    </h2>
                    <p class="mt-1 text-sm text-stone-600">
                        Dikemas segar dengan katup satu arah (<em>one-way valve</em>) untuk mengunci aroma alami kopi.
                    </p>
                </div>
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex min-h-[42px] items-center gap-2 self-start rounded-xl border border-stone-300 bg-white px-5 py-2.5 text-xs font-bold text-stone-800 shadow-2xs transition-colors hover:border-stone-900 hover:bg-stone-900 hover:text-white sm:self-auto sm:text-sm"
                >
                    <span>Lihat Seluruh Produk ({{ $stats['total_products'] }})</span>
                    <svg aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full rounded-2xl border border-stone-200 bg-white p-12 text-center">
                        <p class="text-sm text-stone-600">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tentang Usaha / Deskripsi PT Surya Rasa Nusantara -->
    <section id="tentang-usaha" class="scroll-mt-20 mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-12">
            <!-- Left: Corporate Identity Card -->
            <div class="lg:col-span-5">
                <div class="rounded-3xl bg-stone-900 p-7 text-white shadow-xl sm:p-8">
                    <div class="flex items-center gap-4 border-b border-white/10 pb-6">
                        <img
                            src="{{ asset('images/logo-surya.svg') }}"
                            alt="Logo PT Surya Rasa Nusantara"
                            class="h-14 w-14 shrink-0 rounded-full ring-2 ring-amber-400/40"
                        >
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Profil Resmi UMKM</span>
                            <h2 class="mt-0.5 text-xl font-extrabold text-white sm:text-2xl">PT Surya Rasa Nusantara</h2>
                        </div>
                    </div>

                    <p class="mt-6 text-sm leading-relaxed text-stone-300">
                        Berdiri sejak tahun 2022 di Bandar Lampung, <strong class="text-white">PT Surya Rasa Nusantara</strong> menaungi brand <strong class="text-white">Surya Nusantara Kopi</strong> dengan misi memperpendek rantai distribusi antara petani kopi daerah dan penikmat kopi di seluruh Indonesia.
                    </p>

                    <dl class="mt-6 space-y-3 border-t border-white/10 pt-6 text-xs sm:text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="text-stone-400">Nama Website</dt>
                            <dd class="text-right font-semibold text-white">Susilo Apriyansah - Surya Nusantara Kopi</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-stone-400">Badan Usaha</dt>
                            <dd class="text-right font-semibold text-white">PT Surya Rasa Nusantara</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-stone-400">Bidang UMKM</dt>
                            <dd class="text-right font-semibold text-white">Roastery &amp; Produk Kopi Lokal</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-stone-400">Legalitas &amp; Mutu</dt>
                            <dd class="text-right font-semibold text-amber-400">P-IRT &amp; Halal MUI</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Right: Business Description & 3 Pillars -->
            <div class="lg:col-span-7">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Deskripsi Usaha Kami</span>
                <h2 class="mt-1.5 text-3xl font-extrabold tracking-tight text-stone-900 sm:text-4xl">
                    Mengolah Biji Kopi Petani Lokal dengan Standar Roastery Modern
                </h2>
                <p class="mt-4 text-base leading-relaxed text-stone-600">
                    Melalui <strong class="font-semibold text-stone-900">Surya Nusantara Kopi</strong>, kami menjalankan proses kurasi dan produksi secara menyeluruh — mulai dari pemilihan biji hijau (<em>green bean</em>) petik merah, penyangraian berprofil presisi, hingga pengemasan higienis untuk kebutuhan rumahan, kedai kopi, maupun bingkisan korporat.
                </p>

                <div class="mt-7 space-y-4">
                    <div class="flex gap-4 rounded-2xl border border-stone-200/80 bg-stone-50/60 p-4 sm:p-5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-800">
                            <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-stone-900">Kemitraan Langsung Petani Nusantara</h3>
                            <p class="mt-1 text-xs leading-relaxed text-stone-600 sm:text-sm">
                                Biji kopi diperoleh langsung dari koperasi petani di Dataran Tinggi Gayo, Toraja Utara, Kintamani Bali, dan Lampung Barat dengan jaminan kualitas panen petik merah.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 rounded-2xl border border-stone-200/80 bg-stone-50/60 p-4 sm:p-5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-800">
                            <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-stone-900">Small-Batch Roasting Mingguan</h3>
                            <p class="mt-1 text-xs leading-relaxed text-stone-600 sm:text-sm">
                                Disangrai dalam batch kecil setiap pekan dan dapat digiling sesuai alat seduh pilihan Anda (Biji Utuh, V60, French Press, Kopi Tubruk, atau Mesin Espresso).
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 rounded-2xl border border-stone-200/80 bg-stone-50/60 p-4 sm:p-5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-800">
                            <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-stone-900">Kemasan Katup Udara &amp; Layanan Hampers</h3>
                            <p class="mt-1 text-xs leading-relaxed text-stone-600 sm:text-sm">
                                Setiap kemasan dilengkapi <em>one-way degassing valve</em> dan tersedia dalam paket <em>hampers</em> eksklusif untuk hadiah keluarga maupun relasi bisnis.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak & CTA Banner -->
    <section id="kontak" class="scroll-mt-20 mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-stone-200/90 bg-stone-50 p-7 sm:p-10 lg:flex lg:items-center lg:justify-between lg:gap-10">
            <div class="max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Layanan Pelanggan &amp; Roastery</span>
                <h2 class="mt-1.5 text-2xl font-extrabold text-stone-900 sm:text-3xl">
                    Siap Memesan Kopi Segar Hari Ini?
                </h2>
                <p class="mt-2 text-sm leading-relaxed text-stone-600 sm:text-base">
                    Kunjungi katalog produk kami untuk melihat spesifikasi lengkap atau konsultasikan kebutuhan biji kopi Anda bersama tim PT Surya Rasa Nusantara.
                </p>
            </div>

            <div class="mt-6 flex flex-wrap gap-3 lg:mt-0 lg:shrink-0">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex min-h-[46px] items-center justify-center rounded-xl bg-stone-900 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-amber-700"
                >
                    Lihat Katalog Lengkap
                </a>
                <a
                    href="https://wa.me/6281234567890?text={{ urlencode('Halo Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara), saya ingin bertanya mengenai produk kopi.') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex min-h-[46px] items-center justify-center rounded-xl border border-stone-300 bg-white px-6 py-3 text-sm font-bold text-stone-800 transition-colors hover:border-stone-900"
                >
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>
@endsection
