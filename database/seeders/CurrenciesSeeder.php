<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            ['code' => "aed", 'name_ar' => 'الدرهم الاماراتي', 'active' => 1],
            ['code' => "sar", 'name_ar' => 'الريال السعودي', 'active' => 0],
            ['code' => "kwd", 'name_ar' => 'الدينار الكويتي', 'active' => 0],
            ['code' => "omr", 'name_ar' => 'الدينار الكويتي', 'active' => 0],
            ['code' => "qar", 'name_ar' => 'الريال القطري', 'active' => 0],
            ['code' => "bhd", 'name_ar' => 'الدينار البحريني', 'active' => 0]

        ]);
    }
}
