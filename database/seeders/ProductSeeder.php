<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('product_images')->delete();

        DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 17,
                'product_name' => 'Magnifique',
                'category_id' => 3,
                'original_price' => '310000.00',
                'sale_price' => NULL,
                'stock' => 50,
                'weight' => 2000,
                'label' => NULL,
                'description' => '<p>Magnifique is a luxurious chocolate treat that combines the richness of dark chocolate with the sweetness and natural flavor of premium dates. A perfect indulgence for those who appreciate the finer things in life.</p>',
                'slug' => 'magnifique',
                'created_at' => '2025-10-20 16:33:32',
                'updated_at' => '2025-10-20 16:33:32',
            ),
            1 => 
            array (
                'id' => 18,
                'product_name' => 'Cheesecake Flurry Regular Round',
                'category_id' => 3,
                'original_price' => '415000.00',
                'sale_price' => NULL,
                'stock' => 50,
                'weight' => 2000,
                'label' => NULL,
                'description' => '<p>This decadent dessert combines the creamy perfection of cheesecake with the iconic crunch of cookies and cream. Each bite is a harmonious blend of sweet and savory flavors, making it the perfect ending to any meal.</p>',
                'slug' => 'cheesecake-flurry-regular-round',
                'created_at' => '2025-10-20 16:34:39',
                'updated_at' => '2025-10-20 16:34:39',
            ),
            2 => 
            array (
                'id' => 19,
                'product_name' => 'Red Velvet Small Square',
                'category_id' => 3,
                'original_price' => '395000.00',
                'sale_price' => NULL,
                'stock' => 50,
                'weight' => 15000,
                'label' => NULL,
                'description' => '<p>Our Red Velvet cake is a moist and decadent dessert that\'s perfect for any occasion. The rich, velvety texture of the cake is complemented by the creamy, tangy sweetness of the cream cheese frosting.</p>',
                'slug' => 'red-velvet-small-square',
                'created_at' => '2025-10-20 16:36:06',
                'updated_at' => '2025-10-20 16:40:39',
            ),
            3 => 
            array (
                'id' => 20,
                'product_name' => 'Strawberry Cheesecake',
                'category_id' => 3,
                'original_price' => '415000.00',
                'sale_price' => NULL,
                'stock' => 10,
                'weight' => 3000,
                'label' => NULL,
                'description' => '<p>Our legendary Strawberry Cheesecake is a timeless classic that has been delighting taste buds for generations. Crafted with the finest ingredients, this decadent dessert combines the rich, creamy texture of cheesecake with the sweet, tangy flavor of fresh strawberries. Whether you’re a fan of cheesecake or strawberries, you’re sure to love our legendary Strawberry Cheesecake. It’s the perfect dessert to enjoy on any special occasion or just as a treat for yourself.</p>',
                'slug' => 'strawberry-cheesecake',
                'created_at' => '2025-10-20 16:37:05',
                'updated_at' => '2025-10-20 16:37:05',
            ),
            4 => 
            array (
                'id' => 21,
                'product_name' => 'Tiramisu Small Square',
                'category_id' => 3,
                'original_price' => '260000.00',
                'sale_price' => NULL,
                'stock' => 10,
                'weight' => 15000,
                'label' => NULL,
                'description' => '<h1>Tiramisu Small Square</h1>',
                'slug' => 'tiramisu-small-square',
                'created_at' => '2025-10-20 16:39:58',
                'updated_at' => '2025-10-20 16:39:58',
            ),
            5 => 
            array (
                'id' => 22,
                'product_name' => 'Mix Cheese',
                'category_id' => 3,
                'original_price' => '450000.00',
                'sale_price' => NULL,
                'stock' => 45,
                'weight' => 4000,
                'label' => NULL,
                'description' => '<h1>Mix Cheese</h1><p>Mix Cheese 20x20cm pre-cut cake! Each slice, perfectly sized at 4x4cm, is a heavenly combination of indulgent New York cheesecake. Prepare to be delighted by the rich and creamy texture of our New York cheesecake, complemented by a delightful assortment of fresh fruits.</p>',
                'slug' => 'mix-cheese',
                'created_at' => '2025-10-20 16:42:10',
                'updated_at' => '2025-10-20 16:42:10',
            ),
            6 => 
            array (
                'id' => 23,
                'product_name' => 'Red Velvet',
                'category_id' => 4,
                'original_price' => '48000.00',
                'sale_price' => NULL,
                'stock' => 100,
                'weight' => 100,
                'label' => NULL,
                'description' => '<h1><strong>Red Velvet</strong></h1><p>This popular cake keeps spreading in popularity. Its layers of soft sponge &amp; cream are courteous.</p>',
                'slug' => 'red-velvet-1',
                'created_at' => '2025-10-20 16:54:29',
                'updated_at' => '2025-10-20 16:54:29',
            ),
            7 => 
            array (
                'id' => 24,
                'product_name' => 'Classic Opera',
                'category_id' => 4,
                'original_price' => '48000.00',
                'sale_price' => NULL,
                'stock' => 50,
                'weight' => 100,
                'label' => NULL,
                'description' => '<h1>Classic Opera</h1><p>The perfect combination of dark chocolate and fresh coffee. Every bite is full of indulgence</p><p><br></p>',
                'slug' => 'classic-opera',
                'created_at' => '2025-10-20 16:56:20',
                'updated_at' => '2025-10-20 16:56:20',
            ),
            8 => 
            array (
                'id' => 25,
                'product_name' => 'Lapis Legit Plain Slice Cake',
                'category_id' => 4,
                'original_price' => '25000.00',
                'sale_price' => NULL,
                'stock' => 1000,
                'weight' => 50,
                'label' => NULL,
                'description' => '<p>A popular local delicacy, made with the highest quality ingredients, creating a dense and tasty cake for everyone to enjoy.</p>',
                'slug' => 'lapis-legit-plain-slice-cake',
                'created_at' => '2025-10-20 16:57:32',
                'updated_at' => '2025-10-20 16:57:32',
            ),
            9 => 
            array (
                'id' => 26,
                'product_name' => 'Almond Croissant',
                'category_id' => 5,
                'original_price' => '30000.00',
                'sale_price' => NULL,
                'stock' => 50,
                'weight' => 100,
                'label' => NULL,
                'description' => '<h1>Almond Croissant</h1><p>Nutty, rich, and delightfully indulgent</p><p>Filled with fragrant&nbsp;<strong>almond frangipane and browned butter</strong>&nbsp;for a smooth, nutty-sweet flavor that melts in your mouth. Perfect for those who love an elegant, roasted almond profile in every flaky bite.</p><p><br></p>',
                'slug' => 'almond-croissant',
                'created_at' => '2025-10-20 17:00:56',
                'updated_at' => '2025-10-20 17:00:56',
            ),
            10 => 
            array (
                'id' => 27,
                'product_name' => 'Croissant Crookie',
                'category_id' => 5,
                'original_price' => '32000.00',
                'sale_price' => NULL,
                'stock' => 100,
                'weight' => 100,
                'label' => NULL,
                'description' => '<h1>Croissant Crookie</h1><p>A playful twist on two classics</p><p>A unique fusion of buttery croissant and homemade&nbsp;<strong>dark chocolate chip cookie</strong>&nbsp;dough on top. Crispy outside, gooey inside! the perfect combo of flaky pastry and soft cookie in one bite.</p><p><br></p>',
                'slug' => 'croissant-crookie',
                'created_at' => '2025-10-20 17:02:35',
                'updated_at' => '2025-10-20 17:02:35',
            ),
        ));

        DB::table('product_images')->insert(array (
            0 => 
            array (
                'id' => 48,
                'product_id' => 25,
                'image' => 'product/DtLsrUAGWSuh07sVFiggg8RLkhLrCuMo9o9inv0p.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:33:01',
                'updated_at' => '2025-10-20 21:33:01',
            ),
            1 => 
            array (
                'id' => 49,
                'product_id' => 27,
                'image' => 'product/qvLW1ZJf7AUb0uIvAfyXD7xoYWEZw0csXCHwPeZW.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:33:16',
                'updated_at' => '2025-10-20 21:33:16',
            ),
            2 => 
            array (
                'id' => 50,
                'product_id' => 26,
                'image' => 'product/GXJQT0OoVPfItYIDaqmBleUGGNklHdyi3YhXZS4Q.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:34:13',
                'updated_at' => '2025-10-20 21:34:13',
            ),
            3 => 
            array (
                'id' => 51,
                'product_id' => 24,
                'image' => 'product/7hLIDglJBDbowcDgc2TpFffNhwAV6RBzWXgFTryR.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:34:29',
                'updated_at' => '2025-10-20 21:34:29',
            ),
            4 => 
            array (
                'id' => 52,
                'product_id' => 23,
                'image' => 'product/5sJFEOFMGqPAkePWbBx5wcuqkIYq7YdeeBN6DcmQ.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:34:43',
                'updated_at' => '2025-10-20 21:34:43',
            ),
            5 => 
            array (
                'id' => 53,
                'product_id' => 22,
                'image' => 'product/tG6F4c9UPsv0b00biGjJRDhtMqjKu9QpGHH5XN5u.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:35:27',
                'updated_at' => '2025-10-20 21:35:27',
            ),
            6 => 
            array (
                'id' => 54,
                'product_id' => 21,
                'image' => 'product/23nusAnoEOvWZstmLGAHKcoEjXL7SY1iPzMgLbvk.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:35:40',
                'updated_at' => '2025-10-20 21:35:40',
            ),
            7 => 
            array (
                'id' => 55,
                'product_id' => 20,
                'image' => 'product/sXojMT8K5jXBnfXzZ85bpjTY2V53bWeysIdllRQI.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:36:06',
                'updated_at' => '2025-10-20 21:36:06',
            ),
            8 => 
            array (
                'id' => 56,
                'product_id' => 19,
                'image' => 'product/Odj0L8kKqJsQuKCUeDPdqL34lPulti3nIdQBOfYe.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:36:36',
                'updated_at' => '2025-10-20 21:36:36',
            ),
            9 => 
            array (
                'id' => 57,
                'product_id' => 18,
                'image' => 'product/Q4RnUhSbf4K1sJdvCdRD3bDlrkWMVasBfnRk8eKT.webp',
                'is_primary' => 1,
                'created_at' => '2025-10-20 21:36:52',
                'updated_at' => '2025-10-20 21:36:52',
            ),
        ));
    }
}
