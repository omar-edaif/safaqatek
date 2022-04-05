<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // \App\Models\User::factory(10)->create();
        \App\Models\ProductCategories::create(['name_en' => 'motors', 'name_ar' => 'محركات']);
        \App\Models\Product::factory(30)->create();
    }
}
