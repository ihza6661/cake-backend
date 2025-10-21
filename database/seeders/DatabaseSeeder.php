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
        AdminUser::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        SiteUser::firstOrCreate(
            ['email' => 'desi@gmail.com'],
            [
                'name' => 'Desi Anggraini',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
