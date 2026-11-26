<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UmkmWebsiteTest extends TestCase
{
    use RefreshDatabase;

    private function fakeJpegUpload(string $filename = 'produk-baru.jpg'): UploadedFile
    {
        $samplePath = database_path('seeders/assets/products/aceh-gayo.jpg');
        $content = file_get_contents($samplePath);

        return UploadedFile::fake()->createWithContent($filename, $content);
    }

    public function test_seeder_populates_admin_categories_and_at_least_five_products(): void
    {
        Storage::fake('public');

        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', ['email' => 'admin@suryakopi.id']);
        $this->assertGreaterThanOrEqual(4, Category::count());
        $this->assertGreaterThanOrEqual(5, Product::count());

        $product = Product::with('category')->first();
        $this->assertNotNull($product->category);
        $this->assertTrue(Storage::disk('public')->exists($product->image));
    }

    public function test_public_pages_render_dynamic_umkm_data(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertSee('Susilo Apriyansah - Surya Nusantara Kopi');
        $homeResponse->assertSee('PT Surya Rasa Nusantara');

        $catalogResponse = $this->get(route('products.index'));
        $catalogResponse->assertOk();
        $catalogResponse->assertSee('Arabica Aceh Gayo Highland 250g');

        $filterResponse = $this->get(route('products.index', [
            'kategori' => 'minuman-cold-brew',
            'q' => 'Gula Aren',
        ]));
        $filterResponse->assertOk();
        $filterResponse->assertSee('Cold Brew Kopi Susu Gula Aren 500ml');

        $product = Product::where('slug', 'arabica-aceh-gayo-highland-250g')->firstOrFail();
        $detailResponse = $this->get(route('products.show', $product->slug));
        $detailResponse->assertOk();
        $detailResponse->assertSee($product->name);
        $detailResponse->assertSee($product->category->name);
    }

    public function test_admin_routes_require_authentication_and_login_works(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get(route('admin.products.index'))
            ->assertRedirect(route('login'));

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@suryakopi.id',
            'password' => 'salahpassword',
        ])->assertSessionHasErrors('email');

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@suryakopi.id',
            'password' => 'password123',
        ])->assertRedirect(route('admin.products.index'));

        $this->get(route('admin.dashboard'))->assertOk();
    }

    public function test_admin_product_server_side_validation_enforces_required_max_and_types(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@suryakopi.id')->firstOrFail();

        // 1. Wajib diisi (required)
        $this->actingAs($admin)
            ->post(route('admin.products.store'), [])
            ->assertSessionHasErrors(['category_id', 'name', 'price', 'stock', 'weight_gram', 'description', 'image']);

        // 2. Maksimal karakter & tipe data (max length, integer, image mime)
        $notAnImage = UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf');
        $category = Category::firstOrFail();

        $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => str_repeat('A', 160),
                'price' => 'bukan-angka',
                'stock' => -5,
                'weight_gram' => 'abc',
                'description' => 'Terlalu pendek',
                'image' => $notAnImage,
            ])
            ->assertSessionHasErrors(['name', 'price', 'stock', 'weight_gram', 'description', 'image']);
    }

    public function test_admin_can_create_update_and_delete_product_with_image_storage(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@suryakopi.id')->firstOrFail();
        $category = Category::firstOrFail();

        // Create
        $upload1 = $this->fakeJpegUpload('flores-bajawa.jpg');
        $createResponse = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Arabica Flores Bajawa Natural 250g',
            'price' => 99000,
            'stock' => 18,
            'weight_gram' => 250,
            'roast_level' => 'Medium Roast',
            'origin' => 'Bajawa, Nusa Tenggara Timur',
            'description' => 'Kopi Arabica Flores Bajawa dengan proses natural yang menghadirkan aroma buah beri dan rasa cokelat manis yang lembut.',
            'image' => $upload1,
            'is_featured' => '1',
        ]);

        $createResponse->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Arabica Flores Bajawa Natural 250g')->firstOrFail();
        $oldImagePath = $product->image;
        $this->assertNotNull($oldImagePath);
        $this->assertTrue(Storage::disk('public')->exists($oldImagePath));

        // Update with new image
        $upload2 = $this->fakeJpegUpload('flores-updated.jpg');
        $updateResponse = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Arabica Flores Bajawa Reserve 250g',
            'price' => 105000,
            'stock' => 22,
            'weight_gram' => 250,
            'roast_level' => 'Light-Medium Roast',
            'origin' => 'Bajawa, NTT (1.450 mdpl)',
            'description' => 'Edisi reserve Arabica Flores Bajawa dengan rasa fruity cerah dan aftertaste cokelat karamel yang bersih.',
            'image' => $upload2,
        ]);

        $updateResponse->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertSame('Arabica Flores Bajawa Reserve 250g', $product->name);
        $this->assertSame(105000, $product->price);
        $this->assertFalse(Storage::disk('public')->exists($oldImagePath));
        $this->assertTrue(Storage::disk('public')->exists($product->image));

        // Delete
        $finalImagePath = $product->image;
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.products.destroy', $product));
        $deleteResponse->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertFalse(Storage::disk('public')->exists($finalImagePath));
    }

    public function test_admin_can_crud_category(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@suryakopi.id')->firstOrFail();

        $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Peralatan Seduh Manual',
            'description' => 'V60 dripper, server kaca, dan kertas filter pilihan.',
        ])->assertRedirect(route('admin.categories.index'));

        $category = Category::where('name', 'Peralatan Seduh Manual')->firstOrFail();

        $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'name' => 'Alat Seduh Kopi',
            'description' => 'Peralatan manual brew berkualitas.',
        ])->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Alat Seduh Kopi']);

        $this->actingAs($admin)->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
