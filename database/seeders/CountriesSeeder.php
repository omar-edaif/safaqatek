<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
                'code' => 'SA',
                'dialCode' => '966',
                'maxLength' => 9,
                'minLength' => 9,
                'flag'  => 'storage/images/flags/sa.jpg',


            ],
            [
                "name_ar" => "مملكة البحرين",
                "name_en" => "Kingdom of Bahrain",
                'code' => 'BH',
                'dialCode' => '973',
                'maxLength' => 8,
                'minLength' => 8,
                'flag'  => 'storage/images/flags/br.jpg',
            ],
            [
                "name_ar" => "الإمارات العربية المتحدة",
                "name_en" => 'United Arab Emirates',
                'code' => 'AE',
                'dialCode' => '971',
                'maxLength' => 9,
                'minLength' => 9,
                'flag'  => 'storage/images/flags/ae.jpg',
            ],
            [
                "name_ar" => "سلطنة عمان",
                "name_en" => "Sultanate of Oman",
                'code' => 'OM',
                'dialCode' => '968',
                'maxLength' => 8,
                'minLength' => 8,
                'flag'  => 'storage/images/flags/om.jpg',
            ],
            [
                "name_ar" => "الكويت",
                "name_en" => "Kuwait",
                'code' => 'KW',
                'dialCode' => '965',
                'maxLength' => 8,
                'minLength' => 8,
                'flag'  => 'storage/images/flags/kw.jpg',
            ],
            [
                "name_ar" => "قطر",
                "name_en" => "Qatar",
                'code' => 'QA',
                'dialCode' => '974',
                'maxLength' => 8,
                'minLength' => 8,
                'flag'  => 'storage/images/flags/qa.jpg',
            ],
        ]);
    }
}
