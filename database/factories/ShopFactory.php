<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    private static int $sequence = 1;

    public function definition()
    {
        return [
            'name' => $this->faker->realtext(10),
            'shop_admin_id' => function (){return self::$sequence++;},
            'area_id' => $this->faker->numberBetween(1,10),
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->address,
            'opening_hour' => $this->faker->realtext(10),
            'holiday' => $this->faker->realtext(10),
            'tel_number' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'overview' => $this->faker->realtext(200),
            'shop_img' => $this->faker->imageUrl($width = 640, $height = 480, $randomize = true, $word = null)
        ];
    }
}
