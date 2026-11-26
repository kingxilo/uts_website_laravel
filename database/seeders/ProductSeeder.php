<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $seedAssetsDir = database_path('seeders/assets/products');

        $products = [
            [
                'category_slug' => 'biji-kopi-single-origin',
                'name' => 'Arabica Aceh Gayo Highland 250g',
                'slug' => 'arabica-aceh-gayo-highland-250g',
                'price' => 92000,
                'stock' => 45,
                'weight_gram' => 250,
                'roast_level' => 'Medium Roast',
                'origin' => 'Dataran Tinggi Gayo, Aceh (1.500 mdpl)',
                'description' => 'Kopi Arabica unggulan dari petani binaan Dataran Tinggi Gayo dengan metode semi-washed. Menghadirkan aroma rempah hangat, sentuhan cokelat hitam, dan aftertaste manis yang bersih serta seimbang. Sangat cocok untuk seduhan manual brew V60, Kalita, maupun French Press.',
                'image_file' => 'aceh-gayo.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'biji-kopi-single-origin',
                'name' => 'Arabica Toraja Sapan Specialty 250g',
                'slug' => 'arabica-toraja-sapan-specialty-250g',
                'price' => 98000,
                'stock' => 32,
                'weight_gram' => 250,
                'roast_level' => 'Medium-Dark Roast',
                'origin' => 'Sapan, Toraja Utara, Sulawesi Selatan',
                'description' => 'Dipetik merah sempurna dari pegunungan Sapan, Toraja Utara. Memiliki body yang tebal (full body) dengan profil rasa dark chocolate, kacang panggang, dan sedikit nuansa herbal yang lembut. Ideal untuk penikmat kopi berkarakter kuat tanpa rasa pahit berlebihan.',
                'image_file' => 'toraja-sapan.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'biji-kopi-single-origin',
                'name' => 'Arabica Kintamani Bali Honey Process 250g',
                'slug' => 'arabica-kintamani-bali-honey-process-250g',
                'price' => 95000,
                'stock' => 28,
                'weight_gram' => 250,
                'roast_level' => 'Light-Medium Roast',
                'origin' => 'Kintamani, Bangli, Bali (1.350 mdpl)',
                'description' => 'Ditanam di tanah vulkanik subur berdampingan dengan kebun jeruk Kintamani dan diproses secara honey. Menghasilkan keasaman sitrus yang cerah, aroma bunga jeruk, serta rasa manis seperti madu alami. Pilihan favorit untuk Japanese Iced Coffee dan pour-over.',
                'image_file' => 'kintamani-bali.jpg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'kopi-bubuk-artisan',
                'name' => 'Kopi Bubuk Robusta Lampung Premium 250g',
                'slug' => 'kopi-bubuk-robusta-lampung-premium-250g',
                'price' => 52000,
                'stock' => 70,
                'weight_gram' => 250,
                'roast_level' => 'Dark Roast',
                'origin' => 'Lampung Barat, Sumatera',
                'description' => 'Robusta petik merah dari perkebunan rakyat Lampung Barat yang disangrai gelap secara konsisten lalu digiling halus. Menghadirkan aroma kopi tradisional yang harum pekat, rasa karamel pahit-manis yang mantap, dan krema tebal. Sempurna untuk kopi tubruk harian atau campuran kopi susu.',
                'image_file' => 'robusta-lampung.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'kopi-bubuk-artisan',
                'name' => 'House Blend Espresso Nusantara 500g',
                'slug' => 'house-blend-espresso-nusantara-500g',
                'price' => 115000,
                'stock' => 40,
                'weight_gram' => 500,
                'roast_level' => 'Medium-Dark Roast',
                'origin' => 'Blend 70% Arabica Gayo & 30% Robusta Lampung',
                'description' => 'Racikan khas roaster PT Surya Rasa Nusantara yang dirancang khusus untuk menghasilkan espresso dengan krema keemasan tebal dan rasa cokelat-hazelnut yang kuat. Tetap menonjol saat dipadukan dengan susu segar maupun gula aren untuk menu kopi susu kekinian.',
                'image_file' => 'house-blend.jpg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'minuman-cold-brew',
                'name' => 'Cold Brew Kopi Susu Gula Aren 500ml',
                'slug' => 'cold-brew-kopi-susu-gula-aren-500ml',
                'price' => 42000,
                'stock' => 25,
                'weight_gram' => 500,
                'roast_level' => 'Ready to Drink',
                'origin' => 'House Blend Nusantara & Gula Aren Organik',
                'description' => 'Minuman kopi susu siap saji dalam botol kaca higienis ukuran 500ml (cukup untuk 3–4 gelas). Menggunakan konsentrat cold brew 16 jam yang lembut di lambung, susu segar pilihan, dan sirup gula aren murni tanpa pengawet buatan.',
                'image_file' => 'cold-brew-aren.jpg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'minuman-cold-brew',
                'name' => 'Cold Brew Black Single Origin 500ml',
                'slug' => 'cold-brew-black-single-origin-500ml',
                'price' => 38000,
                'stock' => 30,
                'weight_gram' => 500,
                'roast_level' => 'Ready to Drink',
                'origin' => '100% Arabica Aceh Gayo',
                'description' => 'Kopi hitam murni hasil penyeduhan air dingin selama 16 jam dari 100% biji Arabica Aceh Gayo. Tanpa tambahan gula maupun susu, menghadirkan rasa manis alami biji kopi dengan tingkat keasaman rendah dan tekstur sangat halus. Nikmat disajikan bersama es batu.',
                'image_file' => 'cold-brew-black.jpg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'paket-hampers-gift',
                'name' => 'Hampers Surya Nusantara Heritage Box',
                'slug' => 'hampers-surya-nusantara-heritage-box',
                'price' => 245000,
                'stock' => 15,
                'weight_gram' => 850,
                'roast_level' => 'Assorted Roast',
                'origin' => 'Kurasi Aceh Gayo & Toraja Sapan',
                'description' => 'Paket bingkisan eksklusif PT Surya Rasa Nusantara berisi 2 kemasan kopi Single Origin @250g (Aceh Gayo & Toraja Sapan), 1 cangkir keramik artisan, 1 sendok takar kayu jati, dan kartu ucapan personal. Dikemas dalam kotak kraft premium ramah lingkungan.',
                'image_file' => 'hampers-heritage.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $item) {
            $categoryId = $categories[$item['category_slug']] ?? null;
            if (! $categoryId) {
                continue;
            }

            $storagePath = 'products/' . $item['image_file'];
            $sourceFile = $seedAssetsDir . DIRECTORY_SEPARATOR . $item['image_file'];

            if (File::exists($sourceFile)) {
                Storage::disk('public')->put($storagePath, File::get($sourceFile));
            }

            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'weight_gram' => $item['weight_gram'],
                    'roast_level' => $item['roast_level'],
                    'origin' => $item['origin'],
                    'description' => $item['description'],
                    'image' => $storagePath,
                    'is_featured' => $item['is_featured'],
                ]
            );
        }
    }
}
