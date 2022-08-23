<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Shop;
use App\Models\ShopsTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopsTagFactory extends Factory
{
    protected $model = ShopsTag::class;

    private static int $sequence = 1;

    public function definition()
    {
        return [
            'tag_id' => $this->faker->numberBetween(1,5),
            'shop_id' => function (){return self::$sequence++;},
        ];
    }
}
