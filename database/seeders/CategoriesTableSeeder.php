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
                'image' => 'categories/Zh2o5G08JskgBo8mkOGHoYHUVAjauLiKSJsXZ0rW.webp',
                'created_at' => '2025-10-20 16:31:49',
                'updated_at' => '2025-10-20 16:31:49',
            ),
            1 => 
            array (
                'id' => 4,
                'category_name' => 'Portion Cakes',
                'image' => 'categories/YPiWvPkzfjFhQUQVvlffMyNC7MnVqCt6jDooD7zt.webp',
                'created_at' => '2025-10-20 16:49:39',
                'updated_at' => '2025-10-20 16:49:39',
            ),
            2 => 
            array (
                'id' => 5,
                'category_name' => 'Viennoiserie Series',
                'image' => 'categories/xhfdla0xfC7VT1DrLoH6sJrKRWBmQ5I2s9Dh50sz.webp',
                'created_at' => '2025-10-20 16:58:50',
                'updated_at' => '2025-10-20 16:58:50',
            ),
        ));
        
        
    }
}