<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProductCategories::insert([
            ['name_en' => 'motors', 'name_ar' => 'محركات'],
            ['name_en' => 'gold', 'name_ar' => 'دهب'],
            ['name_en' => 'tech', 'name_ar' => 'تكنولوجي'],

        ]);
    }
}
