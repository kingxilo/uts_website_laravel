@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Ubah Produk')
@section('page_title', 'Ubah Produk')

@section('content')
    <div class="rounded-2xl border border-stone-200/80 bg-white p-6 shadow-2xs sm:p-8">
        <div class="mb-6 border-b border-stone-100 pb-4">
            <h2 class="text-lg font-extrabold text-stone-900">Ubah Produk: {{ $product->name }}</h2>
            <p class="mt-0.5 text-xs text-stone-500">Perbarui detail atau unggah foto baru jika ingin mengganti gambar sebelumnya.</p>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
@endsection
