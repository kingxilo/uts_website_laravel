@extends('layouts.admin')

@section('title', 'Susilo Apriyansah - Surya Nusantara Kopi | Ubah Kategori')
@section('page_title', 'Ubah Kategori')

@section('content')
    <div class="max-w-2xl rounded-2xl border border-stone-200/80 bg-white p-6 shadow-2xs sm:p-8">
        <h2 class="text-lg font-extrabold text-stone-900">Ubah Kategori: {{ $category->name }}</h2>

        @if ($errors->any())
            <div id="form-error-summary" role="alert" tabindex="-1" class="mt-5 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-950">
                <p class="font-bold">Periksa isian berikut:</p>
                <ul class="mt-1 list-disc space-y-0.5 pl-4">
                    @foreach ($errors->keys() as $field)
                        <li><a href="#{{ $field }}" class="font-semibold underline">{{ $errors->first($field) }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" novalidate class="mt-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-xs font-bold text-stone-700">
                    Nama Kategori <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm {{ $errors->has('name') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                @error('name')
                    <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-stone-700">Deskripsi Singkat</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm {{ $errors->has('description') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 border-t border-stone-100 pt-5">
                <button type="submit" class="min-h-[42px] rounded-xl bg-stone-900 px-6 py-2.5 text-sm font-bold text-white transition-colors hover:bg-amber-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="inline-flex min-h-[42px] items-center rounded-xl border border-stone-200 px-5 py-2.5 text-sm font-bold text-stone-700 hover:bg-stone-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
