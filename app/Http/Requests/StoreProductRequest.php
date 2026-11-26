<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'price' => ['required', 'integer', 'min:1000', 'max:100000000'],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
            'weight_gram' => ['required', 'integer', 'min:50', 'max:10000'],
            'roast_level' => ['nullable', 'string', 'max:50'],
            'origin' => ['nullable', 'string', 'max:100'],
            'description' => ['required', 'string', 'min:20', 'max:2000'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.integer' => 'Format kategori tidak valid.',
            'category_id.exists' => 'Kategori yang dipilih tidak ditemukan.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.min' => 'Nama produk minimal terdiri dari :min karakter.',
            'name.max' => 'Nama produk maksimal :max karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.integer' => 'Harga produk harus berupa angka bulat.',
            'price.min' => 'Harga produk minimal Rp 1.000.',
            'price.max' => 'Harga produk maksimal Rp 100.000.000.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa angka bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
            'weight_gram.required' => 'Berat/volume produk wajib diisi.',
            'weight_gram.integer' => 'Berat/volume produk harus berupa angka.',
            'weight_gram.min' => 'Berat/volume minimal :min gram/ml.',
            'weight_gram.max' => 'Berat/volume maksimal :max gram/ml.',
            'roast_level.max' => 'Tingkat sangrai maksimal :max karakter.',
            'origin.max' => 'Asal biji kopi maksimal :max karakter.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.min' => 'Deskripsi produk minimal :min karakter agar informatif.',
            'description.max' => 'Deskripsi produk maksimal :max karakter.',
            'image.required' => 'Foto produk wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
