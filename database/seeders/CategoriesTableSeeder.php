<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Whole Cakes',
                'image'  => public_path('images/categories/whole_cakes.webp'),
            ],
            [
                'category_name' => 'Portion Cakes',
                'image'  => public_path('images/categories/portion_cakes.webp'),
            ],
            [
                'category_name' => 'Viennoiserie Series',
                'image'  => public_path('images/categories/ViennoiserieSeries.webp'),
            ]
        ];

        foreach ($categories as $category) {
            if (file_exists($category['image'])) {
                $filename = 'categories/' . Str::random(20) . '.' . pathinfo($category['image'], PATHINFO_EXTENSION);

                Storage::disk('public')->put($filename, file_get_contents($category['image']));

                $category['image'] = $filename;
            } else {
                $category['image'] = 'categories/default.jpg';
            }

            Category::create($category);
        }
    }
}