<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Susilo Apriyansah - Surya Nusantara Kopi | Login Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-surya.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900 antialiased">
    <div class="flex min-h-screen flex-col justify-center px-4 py-12 sm:px-6">
        <div class="mx-auto w-full max-w-md">
            <div class="mb-6 flex justify-center">
                <a href="{{ route('home') }}">
                    <x-brand-logo size="lg" />
                </a>
            </div>

            <div class="rounded-3xl border border-stone-200/80 bg-white p-7 shadow-sm sm:p-8">
                <h1 class="text-xl font-extrabold text-stone-900 sm:text-2xl">Login Panel Admin</h1>
                <p class="mt-1 text-xs text-stone-500 sm:text-sm">Kelola katalog produk &amp; kategori PT Surya Rasa Nusantara.</p>

                @if (session('success'))
                    <div role="status" class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-900">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        id="login-error-summary"
                        role="alert"
                        tabindex="-1"
                        class="mt-5 rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-900"
                    >
                        <p class="font-bold">Gagal masuk:</p>
                        <ul class="mt-1 list-disc space-y-0.5 pl-4">
                            @foreach ($errors->keys() as $field)
                                <li>
                                    <a href="#{{ $field }}" class="font-semibold underline hover:text-rose-950">{{ $errors->first($field) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" novalidate class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-stone-700">Email Admin</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="admin@suryakopi.id"
                            autocomplete="email"
                            aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                            @error('email') aria-describedby="email-error" @enderror
                            class="mt-1.5 min-h-[44px] w-full rounded-xl border px-3.5 py-2.5 text-sm transition-colors {{ $errors->has('email') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                        >
                        @error('email')
                            <p id="email-error" class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-stone-700">Kata Sandi</label>
                        <div class="relative mt-1.5">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Masukkan kata sandi"
                                autocomplete="current-password"
                                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                @error('password') aria-describedby="password-error" @enderror
                                class="min-h-[44px] w-full rounded-xl border py-2.5 pl-3.5 pr-20 text-sm transition-colors {{ $errors->has('password') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                            >
                            <button
                                type="button"
                                id="toggle-password"
                                aria-label="Tampilkan atau sembunyikan kata sandi"
                                class="absolute right-2 top-1.5 rounded-lg px-2.5 py-1.5 text-xs font-bold text-stone-500 hover:bg-stone-100 hover:text-stone-900"
                            >
                                Lihat
                            </button>
                        </div>
                        @error('password')
                            <p id="password-error" class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex cursor-pointer items-center gap-2 text-xs font-medium text-stone-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-stone-300 text-amber-600">
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ route('home') }}" class="text-xs font-bold text-amber-700 hover:underline">
                            &larr; Kembali ke Website
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="min-h-[46px] w-full rounded-xl bg-stone-900 px-5 py-3 text-sm font-bold text-white transition-colors hover:bg-amber-700"
                    >
                        Masuk ke Panel Admin
                    </button>
                </form>

                <!-- One-Click Demo Helper -->
                <div class="mt-6 rounded-2xl border border-amber-200/80 bg-amber-50/60 p-4">
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-xs font-bold text-amber-900">Akun Demo Evaluasi UTS</p>
                        <button
                            type="button"
                            id="fill-demo-btn"
                            class="rounded-lg bg-stone-900 px-3 py-1 text-xs font-bold text-white transition-colors hover:bg-amber-700"
                        >
                            Isi Otomatis
                        </button>
                    </div>
                    <p class="mt-1.5 text-xs text-stone-700">Email: <strong class="font-bold text-stone-900">admin@suryakopi.id</strong></p>
                    <p class="mt-0.5 text-xs text-stone-700">Password: <strong class="font-bold text-stone-900">password123</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const summary = document.getElementById('login-error-summary');
            if (summary) summary.focus();

            const pwdInput = document.getElementById('password');
            const toggleBtn = document.getElementById('toggle-password');
            toggleBtn?.addEventListener('click', () => {
                const isPwd = pwdInput.type === 'password';
                pwdInput.type = isPwd ? 'text' : 'password';
                toggleBtn.textContent = isPwd ? 'Tutup' : 'Lihat';
            });

            const fillBtn = document.getElementById('fill-demo-btn');
            const emailInput = document.getElementById('email');
            fillBtn?.addEventListener('click', () => {
                emailInput.value = 'admin@suryakopi.id';
                pwdInput.value = 'password123';
                emailInput.focus();
            });
        });
    </script>
</body>
</html>
