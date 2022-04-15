<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'product_id' => rand(1, 10),
            'key' => generateKey(),
            'participate_with' => rand(1, 3)
        ];
    }
}
