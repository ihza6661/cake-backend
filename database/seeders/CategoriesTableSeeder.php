<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 3,
                'category_name' => 'Whole Cakes',
                'image' => 'whole_cakes.webp',
                'created_at' => '2025-10-20 16:31:49',
                'updated_at' => '2025-10-20 16:31:49',
            ),
            1 => 
            array (
                'id' => 4,
                'category_name' => 'Portion Cakes',
                'image' => 'Portion_Cakes.webp',
                'created_at' => '2025-10-20 16:49:39',
                'updated_at' => '2025-10-20 16:49:39',
            ),
            2 => 
            array (
                'id' => 5,
                'category_name' => 'Viennoiserie Series',
                'image' => 'ViennoiserieSeries.webp',
                'created_at' => '2025-10-20 16:58:50',
                'updated_at' => '2025-10-20 16:58:50',
            ),
        ));
        
        
    }
}