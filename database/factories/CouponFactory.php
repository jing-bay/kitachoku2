<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'shop_id' => $this->faker->numberBetween(1,100),
            'name' => $this->faker->realText(20)
        ];
    }
}
