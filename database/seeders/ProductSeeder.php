<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_name'   => 'Nastar',
                'category_id'    => 1,
                'original_price' => 200000,
                'sale_price'     => 150000,
                'stock'          => 1,
                'weight'         => 50,
                'description'    => 'Kue kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/nastar-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/nastar-2.jpg'),
                        'is_primary' => false,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/nastar-3.png'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Putri Salju',
                'category_id'    => 1,
                'original_price' => 100000,
                'sale_price'     => null,
                'stock'          => 1,
                'weight'         => 50,
                'description'    => 'Kue kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/putri-salju-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/putri-salju-2.jpeg'),
                        'is_primary' => false,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/putri-salju-3.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Kastengel',
                'category_id'    => 1,
                'original_price' => 80000,
                'stock'          => 2,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/kastengel-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/kastengel-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Kacang Karang',
                'category_id'    => 1,
                'original_price' => 80000,
                'sale_price' => 70000,
                'stock'          => 2,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/kacang-karang-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/kacang-karang-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Sagu Keju',
                'category_id'    => 1,
                'original_price' => 75000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/sagu-keju-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/sagu-keju-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Lidah Kucing',
                'category_id'    => 1,
                'original_price' => 75000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/lidah-kucing-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/lidah-kucing-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Semprit',
                'category_id'    => 1,
                'original_price' => 95000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/semprit-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/semprit-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Thumbprint Strawberry',
                'category_id'    => 1,
                'original_price' => 195000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/thumbprint-trawberry-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/thumbprint-trawberry-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Dahlia',
                'category_id'    => 1,
                'original_price' => 95000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/dahlia-1.jpeg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/dahlia-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Kacang',
                'category_id'    => 1,
                'original_price' => 95000,
                'stock'          => 1,
                'weight'         => 200,
                'description'    => 'Kue Kering',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/kacang-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/kacang-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Kue Lapis Legit',
                'category_id'    => 2,
                'original_price' => 150000,
                'sale_price'     => 140000,
                'stock'          => 1,
                'weight'         => 150,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/lapis-legit-1.webp'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/lapis-legit-2.webp'),
                        'is_primary' => false,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/lapis-legit-3.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Kue Lapis Surabaya',
                'category_id'    => 2,
                'original_price' => 200000,
                'sale_price'     => 150000,
                'stock'          => 2,
                'weight'         => 2000,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/lapis-surabaya-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/lapis-surabaya-2.jpg'),
                        'is_primary' => false,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/lapis-surabaya-3.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Cucur',
                'category_id'    => 2,
                'original_price' => 200000,
                'sale_price'     => 150000,
                'stock'          => 2,
                'weight'         => 2000,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/cucur-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/cucur-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Talam Pandan',
                'category_id'    => 2,
                'original_price' => 200000,
                'sale_price'     => 150000,
                'stock'          => 2,
                'weight'         => 2000,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/talam-pandan.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/talam-pandan-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Pukis',
                'category_id'    => 2,
                'original_price' => 200000,
                'sale_price'     => 150000,
                'stock'          => 2,
                'weight'         => 2000,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/pukis.webp'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/pukis-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'product_name'   => 'Bolu Pisang',
                'category_id'    => 2,
                'original_price' => 100000,
                'stock'          => 1,
                'weight'         => 2000,
                'description'    => 'Kue Basah',
                'images'         => [
                    [
                        'image'       => public_path('yulita-cakes/bolu-pisang-1.jpg'),
                        'is_primary' => true,
                    ],
                    [
                        'image'       => public_path('yulita-cakes/bolu-pisang-2.jpg'),
                        'is_primary' => false,
                    ],
                ],
            ],
        ];

        foreach ($products as $productData) {
            $images = $productData['images'] ?? [];
            unset($productData['images']);

            $product = Product::create($productData);

            foreach ($images as $image) {
                if (file_exists($image['image'])) {
                    $filename = 'products/' . Str::random(20) . '.' . pathinfo($image['image'], PATHINFO_EXTENSION);

                    Storage::disk('public')->put($filename, file_get_contents($image['image']));

                    $image['image'] = $filename;
                } else {
                    $image['image'] = 'products/default.jpg';
                }

                $image['product_id'] = $product->id;

                ProductImage::create($image);
            }
        }
    }
}
