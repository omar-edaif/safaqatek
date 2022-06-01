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
            ['code' => "aed", 'name_ar' => 'درهم', 'active' => 1],
            ['code' => "sar", 'name_ar' => 'ريال', 'active' => 0],
            ['code' => "kwd", 'name_ar' => 'دينار', 'active' => 0],
            ['code' => "qar", 'name_ar' => 'ريال', 'active' => 0],
        ]);
    }
}
