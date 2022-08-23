<?php

namespace Database\Factories;

use App\Models\ShopAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopAdminFactory extends Factory
{
    protected $model = ShopAdmin::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $this->faker->password,
            'remember_token' => Str::random(10)
        ];
    }
}
