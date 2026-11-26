@php
    $isEdit = isset($product);
@endphp

@if ($errors->any())
    <div
        id="form-error-summary"
        role="alert"
        tabindex="-1"
        aria-labelledby="error-summary-title"
        class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-950"
    >
        <h3 id="error-summary-title" class="font-bold text-rose-900">
            Terdapat {{ $errors->count() }} kesalahan pada isian formulir:
        </h3>
        <ul class="mt-1.5 list-disc space-y-1 pl-5 text-xs">
            @foreach ($errors->keys() as $field)
                <li>
                    <a href="#{{ $field }}" class="font-semibold underline hover:text-rose-700">
                        {{ $errors->first($field) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-8 lg:grid-cols-12">
    <div class="space-y-5 lg:col-span-8">
        <!-- Nama Produk -->
        <div>
            <div class="flex items-center justify-between gap-2">
                <label for="name" class="block text-xs font-bold text-stone-700">
                    Nama Produk <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <span id="name-counter" class="text-xs font-medium text-stone-400 tabular-nums">0 / 150</span>
            </div>
            <input
                type="text"
                id="name"
                name="name"
                maxlength="160"
                value="{{ old('name', $product->name ?? '') }}"
                placeholder="Contoh: Arabica Flores Bajawa Natural 250g"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                aria-describedby="name-hint{{ $errors->has('name') ? ' name-error' : '' }}"
                class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm {{ $errors->has('name') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
            >
            <p id="name-hint" class="mt-1 text-xs text-stone-500">Wajib diisi, minimal 3 dan maksimal 150 karakter.</p>
            @error('name')
                <p id="name-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori & Tingkat Sangrai -->
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="category_id" class="block text-xs font-bold text-stone-700">
                    Kategori Produk <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <select
                    id="category_id"
                    name="category_id"
                    aria-invalid="{{ $errors->has('category_id') ? 'true' : 'false' }}"
                    @error('category_id') aria-describedby="category-error" @enderror
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm {{ $errors->has('category_id') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p id="category-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="roast_level" class="block text-xs font-bold text-stone-700">Tingkat Sangrai / Sajian</label>
                <input
                    type="text"
                    id="roast_level"
                    name="roast_level"
                    value="{{ old('roast_level', $product->roast_level ?? '') }}"
                    placeholder="Contoh: Medium Roast / Ready to Drink"
                    aria-invalid="{{ $errors->has('roast_level') ? 'true' : 'false' }}"
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm {{ $errors->has('roast_level') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                @error('roast_level')
                    <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Harga, Stok, Berat -->
        <div class="grid gap-5 sm:grid-cols-3">
            <div>
                <label for="price" class="block text-xs font-bold text-stone-700">
                    Harga Satuan (Rp) <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price', $product->price ?? '') }}"
                    placeholder="92000"
                    aria-invalid="{{ $errors->has('price') ? 'true' : 'false' }}"
                    aria-describedby="price-preview{{ $errors->has('price') ? ' price-error' : '' }}"
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm tabular-nums {{ $errors->has('price') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                <p id="price-preview" class="mt-1 text-xs text-stone-500 tabular-nums">Angka bulat, min. Rp 1.000</p>
                @error('price')
                    <p id="price-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-xs font-bold text-stone-700">
                    Stok Gudang <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', $product->stock ?? 15) }}"
                    placeholder="25"
                    aria-invalid="{{ $errors->has('stock') ? 'true' : 'false' }}"
                    @error('stock') aria-describedby="stock-error" @enderror
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm tabular-nums {{ $errors->has('stock') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                @error('stock')
                    <p id="stock-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="weight_gram" class="block text-xs font-bold text-stone-700">
                    Berat / Isi (g/ml) <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <input
                    type="number"
                    id="weight_gram"
                    name="weight_gram"
                    value="{{ old('weight_gram', $product->weight_gram ?? 250) }}"
                    placeholder="250"
                    aria-invalid="{{ $errors->has('weight_gram') ? 'true' : 'false' }}"
                    @error('weight_gram') aria-describedby="weight-error" @enderror
                    class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm tabular-nums {{ $errors->has('weight_gram') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
                >
                @error('weight_gram')
                    <p id="weight-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Asal Biji -->
        <div>
            <label for="origin" class="block text-xs font-bold text-stone-700">Daerah Asal Biji / Racikan</label>
            <input
                type="text"
                id="origin"
                name="origin"
                value="{{ old('origin', $product->origin ?? '') }}"
                placeholder="Contoh: Dataran Tinggi Gayo, Aceh (1.500 mdpl)"
                class="mt-1.5 min-h-[42px] w-full rounded-xl border px-3.5 py-2 text-sm {{ $errors->has('origin') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
            >
            @error('origin')
                <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <div class="flex items-center justify-between gap-2">
                <label for="description" class="block text-xs font-bold text-stone-700">
                    Deskripsi Produk <span class="text-rose-600" aria-hidden="true">*</span>
                </label>
                <span id="desc-counter" class="text-xs font-medium text-stone-400 tabular-nums">0 / 2000</span>
            </div>
            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Uraikan karakter rasa, aroma, metode pascapanen, dan rekomendasi seduh..."
                aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}"
                aria-describedby="desc-hint{{ $errors->has('description') ? ' desc-error' : '' }}"
                class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm leading-relaxed {{ $errors->has('description') ? 'border-rose-500 bg-rose-50/40' : 'border-stone-200 bg-white focus:border-amber-600' }}"
            >{{ old('description', $product->description ?? '') }}</textarea>
            <p id="desc-hint" class="mt-1 text-xs text-stone-500">Wajib diisi, minimal 20 karakter dan maksimal 2.000 karakter.</p>
            @error('description')
                <p id="desc-error" class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Featured Checkbox -->
        <div class="rounded-2xl border border-stone-200/80 bg-stone-50/70 p-4">
            <label class="inline-flex cursor-pointer items-start gap-3">
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    @checked(old('is_featured', $product->is_featured ?? false))
                    class="mt-0.5 h-4 w-4 rounded border-stone-300 text-amber-600"
                >
                <div>
                    <span class="block text-sm font-bold text-stone-900">Tampilkan sebagai Produk Unggulan</span>
                    <span class="block text-xs text-stone-500">Produk ini akan ditampilkan pada seksi produk unggulan di halaman Beranda.</span>
                </div>
            </label>
        </div>
    </div>

    <!-- Image Upload Box -->
    <div class="lg:col-span-4">
        <div class="rounded-2xl border border-stone-200/80 bg-stone-50/70 p-5">
            <label for="image" class="block text-xs font-bold text-stone-700">
                Foto Produk {!! $isEdit ? '<span class="font-normal text-stone-500">(Opsional saat ubah)</span>' : '<span class="text-rose-600" aria-hidden="true">*</span>' !!}
            </label>

            <div class="mt-3 overflow-hidden rounded-xl border border-stone-200 bg-white aspect-square">
                <img
                    id="image-preview"
                    src="{{ $isEdit ? $product->image_url : asset('images/logo-surya.svg') }}"
                    alt="Pratinjau foto produk"
                    class="h-full w-full {{ $isEdit ? 'object-cover' : 'object-contain p-10 opacity-50' }}"
                >
            </div>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                aria-invalid="{{ $errors->has('image') ? 'true' : 'false' }}"
                aria-describedby="image-hint{{ $errors->has('image') ? ' image-error' : '' }}"
                class="mt-4 block w-full text-xs text-stone-600 file:mr-3 file:cursor-pointer file:rounded-xl file:border-0 file:bg-stone-900 file:px-3.5 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-amber-700"
            >
            <p id="image-hint" class="mt-2 text-xs leading-relaxed text-stone-500">
                Format <strong>JPG, JPEG, PNG, atau WEBP</strong> (maks. 2 MB). Disimpan di <code>storage/app/public/products</code>.
            </p>
            @error('image')
                <p id="image-error" class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-8 flex flex-wrap items-center gap-3 border-t border-stone-200 pt-6">
    <button
        type="submit"
        class="min-h-[44px] rounded-xl bg-stone-900 px-6 py-2.5 text-sm font-bold text-white transition-colors hover:bg-amber-700"
    >
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Produk Baru' }}
    </button>
    <a
        href="{{ route('admin.products.index') }}"
        class="inline-flex min-h-[44px] items-center rounded-xl border border-stone-200 bg-white px-5 py-2.5 text-sm font-bold text-stone-700 transition-colors hover:bg-stone-50"
    >
        Batal
    </a>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('image');
        const preview = document.getElementById('image-preview');
        const imageHint = document.getElementById('image-hint');
        if (input && preview) {
            input.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (!file) return;
                if (file.size > 2 * 1024 * 1024 && imageHint) {
                    imageHint.textContent = 'Peringatan: Ukuran file melebihi batas 2 MB. Pilih gambar yang lebih kecil.';
                    imageHint.classList.add('text-rose-600', 'font-semibold');
                }
                const reader = new FileReader();
                reader.onload = (ev) => {
                    preview.src = ev.target.result;
                    preview.className = 'h-full w-full object-cover';
                };
                reader.readAsDataURL(file);
            });
        }

        const bindCounter = (inputId, counterId, max) => {
            const el = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            if (!el || !counter) return;
            const update = () => {
                const len = el.value.length;
                counter.textContent = `${len} / ${max}`;
                counter.classList.toggle('text-rose-600', len > max);
            };
            update();
            el.addEventListener('input', update);
        };
        bindCounter('name', 'name-counter', 150);
        bindCounter('description', 'desc-counter', 2000);

        const priceInput = document.getElementById('price');
        const pricePreview = document.getElementById('price-preview');
        if (priceInput && pricePreview) {
            const updatePrice = () => {
                const val = parseInt(priceInput.value || '0', 10);
                if (val > 0) {
                    pricePreview.textContent = 'Format tampil: Rp ' + new Intl.NumberFormat('id-ID').format(val);
                } else {
                    pricePreview.textContent = 'Angka bulat, min. Rp 1.000';
                }
            };
            updatePrice();
            priceInput.addEventListener('input', updatePrice);
        }
    });
</script>
@endpush
