<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            [
                "name_ar" => 'المملكة العربية السعودية',
                "name_en" => "Kingdom of Saudi Arabia",
            ],
            [
                "name_ar" => "مملكة البحرين",
                "name_en" => "Kingdom of Bahrain"
            ],
            [
                "name_ar" => "الإمارات العربية المتحدة",
                "name_en" => 'United Arab Emirates'
            ],
            [
                "name_ar" => "سلطنة عمان",
                "name_en" => "Sultanate of Oman"
            ],
            [
                "name_ar" => "الكويت",
                "name_en" => "Kuwait"
            ],
            [
                "name_ar" => "قطر",
                "name_en" => "Qatar"
            ],
        ]);
    }
}
