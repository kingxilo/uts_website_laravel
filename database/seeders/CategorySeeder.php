<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Biji Kopi Single Origin',
                'slug' => 'biji-kopi-single-origin',
                'description' => 'Biji kopi pilihan dari satu daerah asal di Nusantara, disangrai fresh dalam batch kecil untuk menjaga karakter rasa autentik.',
            ],
            [
                'name' => 'Kopi Bubuk Artisan',
                'slug' => 'kopi-bubuk-artisan',
                'description' => 'Kopi giling segar dengan profil gilingan presisi, siap diseduh untuk kopi tubruk, V60, maupun mesin espresso rumahan.',
            ],
            [
                'name' => 'Minuman Cold Brew',
                'slug' => 'minuman-cold-brew',
                'description' => 'Ekstraksi dingin selama 16 jam menghasilkan kopi botolan yang lembut, rendah asam, dan segar dinikmati kapan saja.',
            ],
            [
                'name' => 'Paket Hampers & Gift',
                'slug' => 'paket-hampers-gift',
                'description' => 'Bingkisan eksklusif kopi Nusantara lengkap dengan kemasan ramah lingkungan untuk hadiah keluarga maupun relasi bisnis.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
