<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteUser>
 */
class SiteUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Venia Aurilia",
            'email' => "veniaaurilia@gmail.com",
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
