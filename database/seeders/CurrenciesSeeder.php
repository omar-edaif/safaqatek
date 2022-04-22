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
            ['code' => "aed"],
            ['code' => "sar"],
            ['code' => "kwd"],
            ['code' => "omr"],
            ['code' => "qar"]

        ]);
    }
}
