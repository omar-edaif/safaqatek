<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_category_id' => rand(1, 3),
            'name_en' => $this->faker->name(),
            'name_ar' => 'الاسم ',
            'award_name_en' => $this->faker->name(),
            'award_name_ar' => 'أسم الجائزة بالعربي',
            'image' => '/images/product/product_0' . rand(0, 1) . '.jpg',
            'award_image' => '/images/product/product_0' . rand(0, 1) . '.jpg',
            'description_ar' => $this->faker->text(40),
            'description_en' => $this->faker->text(40),
            "award_description_en" => $this->faker->text(40),
            "award_description_ar" => $this->faker->text(40),
            'quantity' => rand(100, 400),
            'price' => rand(100, 400),
            'coupon_per_unit' => rand(1, 3),
            'closing_at' => now()->addDay(rand(-50, 50)),
        ];
    }
}
