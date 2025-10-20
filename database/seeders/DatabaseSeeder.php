<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\SiteUser;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminUser::factory(1)->create();
        SiteUser::factory(1)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
