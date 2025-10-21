<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        $productsData = [
            ['id' => 17, 'product_name' => 'Magnifique', 'category_id' => 1, 'original_price' => '310000.00', 'stock' => 50, 'weight' => 2000, 'description' => '<p>A perfect indulgence...</p>', 'slug' => 'magnifique', 'images' => [['filename' => 'Magnifique.webp', 'is_primary' => true]]],
            ['id' => 18, 'product_name' => 'Cheesecake Flurry', 'category_id' => 1, 'original_price' => '415000.00', 'stock' => 50, 'weight' => 2000, 'description' => '<p>A harmonious blend...</p>', 'slug' => 'cheesecake-flurry', 'images' => [['filename' => 'CheesecakeFlurryRegularRound.webp', 'is_primary' => true]]],
            ['id' => 19, 'product_name' => 'Red Velvet Square', 'category_id' => 1, 'original_price' => '395000.00', 'stock' => 50, 'weight' => 15000, 'description' => '<p>A moist and decadent dessert.</p>', 'slug' => 'red-velvet-square', 'images' => [['filename' => 'redvelvet.webp', 'is_primary' => true]]],
            ['id' => 20, 'product_name' => 'Strawberry Cheesecake', 'category_id' => 1, 'original_price' => '415000.00', 'stock' => 10, 'weight' => 3000, 'description' => '<p>A timeless classic.</p>', 'slug' => 'strawberry-cheesecake', 'images' => [['filename' => 'StrawberryCheesecake.webp', 'is_primary' => true]]],
            ['id' => 21, 'product_name' => 'Tiramisu Square', 'category_id' => 1, 'original_price' => '260000.00', 'stock' => 10, 'weight' => 15000, 'description' => '<h1>Tiramisu</h1>', 'slug' => 'tiramisu-square', 'images' => [['filename' => 'TiramisuSmallSquare.webp', 'is_primary' => true]]],
            ['id' => 22, 'product_name' => 'Mix Cheese', 'category_id' => 1, 'original_price' => '450000.00', 'stock' => 45, 'weight' => 4000, 'description' => '<h1>Mix Cheese</h1>', 'slug' => 'mix-cheese', 'images' => [['filename' => 'Mix_Cheese.webp', 'is_primary' => true]]],

            ['id' => 23, 'product_name' => 'Red Velvet', 'category_id' => 2, 'original_price' => '48000.00', 'stock' => 100, 'weight' => 100, 'description' => '<h1>Red Velvet</h1>', 'slug' => 'red-velvet-1', 'images' => [['filename' => 'red_velvet_portion.webp', 'is_primary' => true]]],
            ['id' => 24, 'product_name' => 'Classic Opera', 'category_id' => 2, 'original_price' => '48000.00', 'stock' => 50, 'weight' => 100, 'description' => '<h1>Classic Opera</h1>', 'slug' => 'classic-opera', 'images' => [['filename' => 'classic_opera.webp', 'is_primary' => true]]],
            ['id' => 25, 'product_name' => 'Lapis Legit Slice', 'category_id' => 2, 'original_price' => '25000.00', 'stock' => 1000, 'weight' => 50, 'description' => '<p>A popular local delicacy.</p>', 'slug' => 'lapis-legit-slice', 'images' => [['filename' => 'LapisLegitPlainSliceCake.webp', 'is_primary' => true]]],

            ['id' => 26, 'product_name' => 'Almond Croissant', 'category_id' => 3, 'original_price' => '30000.00', 'stock' => 50, 'weight' => 100, 'description' => '<h1>Almond Croissant</h1>', 'slug' => 'almond-croissant', 'images' => [['filename' => 'Almond_Croissant.webp', 'is_primary' => true]]],
            ['id' => 27, 'product_name' => 'Croissant Crookie', 'category_id' => 3, 'original_price' => '32000.00', 'stock' => 100, 'weight' => 100, 'description' => '<h1>Croissant Crookie</h1>', 'slug' => 'croissant-crookie', 'images' => [['filename' => 'Croissant_Crookie.webp', 'is_primary' => true]]],
        ];

        foreach ($productsData as $productData) {
            $imagesData = $productData['images'];
            unset($productData['images']);

            $product = Product::create($productData);

            foreach ($imagesData as $imageData) {
                $sourcePath = public_path('images/products/' . $imageData['filename']);

                if (file_exists($sourcePath)) {
                    $finalPath = 'products/' . $imageData['filename'];
                    Storage::disk('public')->put($finalPath, file_get_contents($sourcePath));

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $finalPath,
                        'is_primary' => $imageData['is_primary'],
                    ]);
                }
            }
        }
    }
}
