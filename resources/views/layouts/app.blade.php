<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Susilo Apriyansah - Surya Nusantara Kopi | PT Surya Rasa Nusantara')</title>
    <meta name="description" content="@yield('meta_description', 'Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara) — UMKM roastery kopi lokal Nusantara yang menghadirkan biji kopi single origin, kopi bubuk artisan, cold brew, dan hampers eksklusif.')">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-surya.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-white text-stone-900 antialiased selection:bg-amber-100 selection:text-amber-950">
    <a
        href="#main-content"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-stone-900 focus:px-4 focus:py-2.5 focus:text-sm focus:font-semibold focus:text-white focus:shadow-lg"
    >
        Lewati ke konten utama
    </a>

    <!-- Clean Sticky Navbar -->
    <header class="sticky top-0 z-40 border-b border-stone-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3.5 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="shrink-0">
                <x-brand-logo />
            </a>

            <!-- Centered Pill Navigation -->
            <nav aria-label="Navigasi Utama" class="hidden items-center gap-1 rounded-full border border-stone-200/80 bg-stone-50/80 p-1 md:flex">
                <a
                    href="{{ route('home') }}"
                    @if (request()->routeIs('home')) aria-current="page" @endif
                    class="rounded-full px-4 py-1.5 text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'bg-white text-stone-900 shadow-2xs' : 'text-stone-600 hover:text-stone-900' }}"
                >
                    Beranda
                </a>
                <a
                    href="{{ route('products.index') }}"
                    @if (request()->routeIs('products.*')) aria-current="page" @endif
                    class="rounded-full px-4 py-1.5 text-sm font-semibold transition-all {{ request()->routeIs('products.*') ? 'bg-white text-stone-900 shadow-2xs' : 'text-stone-600 hover:text-stone-900' }}"
                >
                    Katalog Produk
                </a>
                <a
                    href="{{ route('home') }}#tentang-usaha"
                    class="rounded-full px-4 py-1.5 text-sm font-semibold text-stone-600 transition-all hover:text-stone-900"
                >
                    Tentang Usaha
                </a>
                <a
                    href="{{ route('home') }}#kontak"
                    class="rounded-full px-4 py-1.5 text-sm font-semibold text-stone-600 transition-all hover:text-stone-900"
                >
                    Kontak
                </a>
            </nav>

            <!-- Right Actions -->
            <div class="hidden items-center gap-2.5 md:flex">
                @auth
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex min-h-[40px] items-center gap-2 rounded-xl bg-amber-600 px-4 py-2 text-xs font-bold text-white shadow-xs transition-colors hover:bg-amber-700"
                    >
                        <span>Panel Admin</span>
                        <svg aria-hidden="true" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex min-h-[40px] items-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-800 shadow-2xs transition-colors hover:border-stone-900 hover:bg-stone-900 hover:text-white"
                    >
                        <svg aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>Login Admin</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button
                type="button"
                id="mobile-menu-btn"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="mobile-menu"
                class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-stone-200 bg-white text-stone-800 md:hidden"
            >
                <svg id="icon-menu-open" aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg id="icon-menu-close" aria-hidden="true" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden border-t border-stone-200 bg-white px-4 py-4 shadow-lg md:hidden">
            <nav aria-label="Navigasi Mobile" class="flex flex-col gap-1">
                <a href="{{ route('home') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-800' : 'text-stone-800 hover:bg-stone-50' }}">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold {{ request()->routeIs('products.*') ? 'bg-amber-50 text-amber-800' : 'text-stone-800 hover:bg-stone-50' }}">
                    Katalog Produk
                </a>
                <a href="{{ route('home') }}#tentang-usaha" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-800 hover:bg-stone-50">
                    Tentang Usaha
                </a>
                <a href="{{ route('home') }}#kontak" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-800 hover:bg-stone-50">
                    Kontak
                </a>
                <div class="mt-3 border-t border-stone-100 pt-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex min-h-[44px] w-full items-center justify-center rounded-xl bg-amber-600 px-4 py-2.5 text-sm font-bold text-white">
                            Panel Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex min-h-[44px] w-full items-center justify-center rounded-xl bg-stone-900 px-4 py-2.5 text-sm font-bold text-white">
                            Login Admin
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    <!-- Clean Professional Footer -->
    <footer class="border-t border-stone-200 bg-stone-950 text-stone-300">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <x-brand-logo variant="dark" />
                    <p class="mt-4 max-w-md text-sm leading-relaxed text-stone-400">
                        <strong class="font-semibold text-white">PT Surya Rasa Nusantara</strong> adalah UMKM roastery kopi lokal Indonesia yang menghadirkan biji kopi <em>single origin</em>, kopi bubuk artisan, minuman <em>cold brew</em>, dan paket <em>hampers</em> berkualitas tinggi dari petani Nusantara.
                    </p>
                    <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3.5 py-1.5 text-xs font-medium text-amber-300">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <span>P-IRT &amp; Sertifikasi Halal Terverifikasi</span>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-white">Menu Utama</h2>
                    <ul class="mt-4 space-y-2.5 text-sm text-stone-400">
                        <li><a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="transition-colors hover:text-white">Katalog Produk</a></li>
                        <li><a href="{{ route('home') }}#tentang-usaha" class="transition-colors hover:text-white">Profil PT Surya Rasa Nusantara</a></li>
                        <li><a href="{{ route('login') }}" class="transition-colors hover:text-white">Portal Admin UMKM</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-4">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-white">Roastery &amp; Layanan Pelanggan</h2>
                    <ul class="mt-4 space-y-2.5 text-sm text-stone-400">
                        <li>Jl. Surya Kencana No. 48, Kedaton, Bandar Lampung</li>
                        <li>Senin – Sabtu &bull; 08.00 – 17.00 WIB</li>
                        <li>WhatsApp: <span class="text-stone-200">+62 812-3456-7890</span></li>
                        <li>Email: <span class="text-stone-200">halo@suryakopi.id</span></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 flex flex-col items-start justify-between gap-3 border-t border-white/10 pt-6 text-xs text-stone-500 sm:flex-row sm:items-center">
                <p>&copy; {{ date('Y') }} Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara). Seluruh hak cipta dilindungi.</p>
                <p>UTS Pemrograman Web II &bull; Susilo Apriyansah (24312051)</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('icon-menu-open');
            const closeIcon = document.getElementById('icon-menu-close');

            if (btn && menu) {
                const toggleMenu = (forceClose = false) => {
                    const willClose = forceClose ? true : !menu.classList.contains('hidden');
                    menu.classList.toggle('hidden', willClose);
                    btn.setAttribute('aria-expanded', String(!willClose));
                    openIcon?.classList.toggle('hidden', !willClose);
                    closeIcon?.classList.toggle('hidden', willClose);
                };

                btn.addEventListener('click', () => toggleMenu());
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !menu.classList.contains('hidden')) {
                        toggleMenu(true);
                        btn.focus();
                    }
                });
                menu.querySelectorAll('a').forEach((link) => {
                    link.addEventListener('click', () => toggleMenu(true));
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
