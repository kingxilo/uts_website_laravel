@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Kelola Kategori')
@section('page_title', 'Kelola Kategori')

@section('content')
    <div class="rounded-2xl border border-stone-200/80 bg-white p-5 shadow-2xs sm:p-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-lg font-extrabold text-stone-900">Daftar Kategori Produk</h2>
                <p class="mt-0.5 text-xs text-stone-500">Relasi Eloquent One-to-Many terhadap tabel produk.</p>
            </div>
            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex min-h-[42px] items-center justify-center rounded-xl bg-stone-900 px-4 py-2 text-xs font-bold text-white transition-colors hover:bg-amber-700 sm:text-sm"
            >
                + Tambah Kategori
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full min-w-[620px] text-left text-sm">
                <thead class="border-y border-stone-200 bg-stone-50 text-xs font-bold text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Slug URL</th>
                        <th class="px-4 py-3">Jumlah Produk</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-stone-50/70">
                            <td class="px-4 py-3.5 font-bold text-stone-900">{{ $category->name }}</td>
                            <td class="px-4 py-3.5 text-xs text-stone-500">{{ $category->slug }}</td>
                            <td class="px-4 py-3.5">
                                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-800 tabular-nums">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="px-4 py-3.5 max-w-xs truncate text-stone-600">{{ $category->description ?: '-' }}</td>
                            <td class="px-4 py-3.5 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="inline-flex min-h-[34px] items-center rounded-lg bg-stone-100 px-3 py-1 text-xs font-bold text-stone-800 hover:bg-stone-200"
                                    >
                                        Ubah
                                    </a>
                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        data-confirm-delete="Hapus kategori &ldquo;{{ $category->name }}&rdquo;? Kategori hanya dapat dihapus jika tidak lagi memiliki produk."
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
                            <td colspan="5" class="px-4 py-10 text-center text-sm text-stone-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($categories->hasPages())
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
