<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Admin Panel')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-surya.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">
    <a
        href="#admin-main"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-stone-900 focus:px-4 focus:py-2.5 focus:text-sm focus:font-semibold focus:text-white"
    >
        Lewati ke konten admin
    </a>

    <div class="flex min-h-screen">
        <!-- Clean Modern Sidebar -->
        <aside class="hidden w-64 shrink-0 flex-col border-r border-stone-200 bg-white lg:flex">
            <div class="border-b border-stone-100 px-5 py-4">
                <a href="{{ route('admin.dashboard') }}" class="block">
                    <x-brand-logo size="sm" />
                </a>
            </div>

            <nav aria-label="Menu Panel Admin" class="flex-1 space-y-1 px-3.5 py-5">
                <p class="px-3 pb-1.5 text-[11px] font-bold uppercase tracking-wider text-stone-400">Menu Utama</p>

                <a
                    href="{{ route('admin.dashboard') }}"
                    @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif
                    class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-stone-900 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}"
                >
                    <svg aria-hidden="true" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a
                    href="{{ route('admin.products.index') }}"
                    @if (request()->routeIs('admin.products.*')) aria-current="page" @endif
                    class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-stone-900 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}"
                >
                    <svg aria-hidden="true" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span>Kelola Produk</span>
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    @if (request()->routeIs('admin.categories.*')) aria-current="page" @endif
                    class="flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-stone-900 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}"
                >
                    <svg aria-hidden="true" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    </svg>
                    <span>Kelola Kategori</span>
                </a>

                <div class="pt-5">
                    <p class="px-3 pb-1.5 text-[11px] font-bold uppercase tracking-wider text-stone-400">Tautan Cepat</p>
                    <a
                        href="{{ route('home') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-600 transition-colors hover:bg-stone-100 hover:text-stone-900"
                    >
                        <span>Lihat Website Publik</span>
                        <svg aria-hidden="true" class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                </div>
            </nav>

            <div class="border-t border-stone-100 p-4">
                <div class="mb-3 rounded-xl bg-stone-50 px-3.5 py-2.5">
                    <p class="truncate text-xs font-bold text-stone-900">{{ auth()->user()->name }}</p>
                    <p class="truncate text-[11px] text-stone-500">{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="flex min-h-[38px] w-full items-center justify-center gap-2 rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 transition-colors hover:border-rose-600 hover:bg-rose-600 hover:text-white"
                    >
                        Keluar (Logout)
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace -->
        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 border-b border-stone-200/80 bg-white/90 backdrop-blur-md">
                <div class="flex items-center justify-between gap-4 px-4 py-3.5 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            id="admin-mobile-btn"
                            aria-label="Buka menu navigasi admin"
                            aria-expanded="false"
                            aria-controls="admin-mobile-menu"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-stone-200 text-stone-800 lg:hidden"
                        >
                            <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-lg font-extrabold text-stone-900 sm:text-xl">@yield('page_title', 'Dashboard Admin')</h1>
                            <p class="hidden text-xs text-stone-500 sm:block">Susilo Apriyansah - Surya Nusantara Kopi (PT Surya Rasa Nusantara)</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('home') }}"
                            class="hidden min-h-[38px] items-center rounded-xl border border-stone-200 bg-white px-3.5 py-1.5 text-xs font-bold text-stone-700 transition-colors hover:border-stone-900 sm:inline-flex"
                        >
                            Lihat Web
                        </a>
                        <a
                            href="{{ route('admin.products.create') }}"
                            class="inline-flex min-h-[38px] items-center gap-1.5 rounded-xl bg-stone-900 px-3.5 py-1.5 text-xs font-bold text-white transition-colors hover:bg-amber-700"
                        >
                            <span>+ Produk Baru</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Admin Drawer -->
                <div id="admin-mobile-menu" class="hidden border-t border-stone-200 bg-white px-4 py-4 shadow-lg lg:hidden">
                    <nav aria-label="Menu Mobile Admin" class="flex flex-col gap-1">
                        <a href="{{ route('admin.dashboard') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-stone-900 text-white' : 'text-stone-700' }}">Dashboard</a>
                        <a href="{{ route('admin.products.index') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.products.*') ? 'bg-stone-900 text-white' : 'text-stone-700' }}">Kelola Produk</a>
                        <a href="{{ route('admin.categories.index') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.categories.*') ? 'bg-stone-900 text-white' : 'text-stone-700' }}">Kelola Kategori</a>
                        <a href="{{ route('home') }}" class="rounded-xl px-3.5 py-2.5 text-sm font-semibold text-stone-700">Lihat Website Publik</a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="mt-2 border-t border-stone-100 pt-2">
                            @csrf
                            <button type="submit" class="min-h-[42px] w-full rounded-xl bg-rose-600 px-3.5 py-2 text-left text-sm font-bold text-white">Keluar (Logout)</button>
                        </form>
                    </nav>
                </div>
            </header>

            <main id="admin-main" class="flex-1 p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                    <div role="status" class="mb-6 flex items-center justify-between gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-900">
                        <div class="flex items-center gap-2.5">
                            <svg aria-hidden="true" class="h-4 w-4 shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup pesan" class="rounded p-1 text-emerald-700 hover:bg-emerald-100">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div role="alert" class="mb-6 flex items-center justify-between gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-900">
                        <span>{{ session('error') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup peringatan" class="rounded p-1 text-rose-700 hover:bg-rose-100">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Clean Delete Confirmation Modal -->
    <dialog
        id="confirm-delete-dialog"
        aria-labelledby="delete-dialog-title"
        aria-describedby="delete-dialog-desc"
        class="m-auto w-full max-w-md rounded-2xl border border-stone-200 bg-white p-0 text-stone-900 shadow-2xl backdrop:bg-stone-950/50 backdrop:backdrop-blur-xs"
    >
        <div class="p-6">
            <span class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700">Konfirmasi Hapus</span>
            <h2 id="delete-dialog-title" class="mt-3 text-lg font-extrabold text-stone-900">Hapus data ini?</h2>
            <p id="delete-dialog-desc" class="mt-1.5 text-sm leading-relaxed text-stone-600">
                Data yang dihapus tidak dapat dikembalikan.
            </p>
            <div class="mt-6 flex items-center justify-end gap-2.5">
                <button
                    type="button"
                    id="delete-dialog-cancel"
                    class="min-h-[40px] rounded-xl border border-stone-200 bg-white px-4 py-2 text-xs font-bold text-stone-700 hover:bg-stone-50"
                >
                    Batal
                </button>
                <button
                    type="button"
                    id="delete-dialog-confirm"
                    class="min-h-[40px] rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white hover:bg-rose-700"
                >
                    Ya, Hapus
                </button>
            </div>
        </div>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('admin-mobile-btn');
            const menu = document.getElementById('admin-mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    const isHidden = menu.classList.toggle('hidden');
                    btn.setAttribute('aria-expanded', String(!isHidden));
                });
            }

            const errorSummary = document.getElementById('form-error-summary');
            if (errorSummary) errorSummary.focus();

            const dialog = document.getElementById('confirm-delete-dialog');
            const descEl = document.getElementById('delete-dialog-desc');
            const cancelBtn = document.getElementById('delete-dialog-cancel');
            const confirmBtn = document.getElementById('delete-dialog-confirm');
            let pendingForm = null;

            if (dialog && typeof dialog.showModal === 'function') {
                document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
                    form.addEventListener('submit', (e) => {
                        if (form.dataset.confirmed === 'true') return;
                        e.preventDefault();
                        pendingForm = form;
                        descEl.textContent = form.dataset.confirmDelete || 'Data yang dihapus tidak dapat dikembalikan.';
                        dialog.showModal();
                    });
                });

                cancelBtn?.addEventListener('click', () => {
                    pendingForm = null;
                    dialog.close();
                });

                confirmBtn?.addEventListener('click', () => {
                    if (pendingForm) {
                        pendingForm.dataset.confirmed = 'true';
                        dialog.close();
                        pendingForm.submit();
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
