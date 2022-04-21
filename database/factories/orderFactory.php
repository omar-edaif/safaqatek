<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 5),
            'amount' => rand(300, 8000),
            'currency' => 'aed',
            'transaction_id' => 'pk_' . \Str::random(15),
            'is_donate' => rand(0, 1)
        ];
    }
}
