@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Tambah Produk')
@section('page_title', 'Tambah Produk Baru')

@section('content')
    <div class="rounded-2xl border border-stone-200/80 bg-white p-6 shadow-2xs sm:p-8">
        <div class="mb-6 border-b border-stone-100 pb-4">
            <h2 class="text-lg font-extrabold text-stone-900">Formulir Produk Baru</h2>
            <p class="mt-0.5 text-xs text-stone-500">Lengkapi informasi produk dan unggah foto produk untuk ditampilkan di katalog publik.</p>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @include('admin.products._form')
        </form>
    </div>
@endsection
