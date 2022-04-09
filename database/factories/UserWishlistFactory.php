<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserWishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => rand(1, 10),
            'user_id' => rand(1, 10)
        ];
    }
}
