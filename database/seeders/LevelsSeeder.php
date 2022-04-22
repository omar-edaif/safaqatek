<?php

namespace Database\Seeders;

use App\Models\UserLevels;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevels::insert(
            [
                [
                    'name_en'              => 'BRONZE',
                    'name_ar'           => 'برونزي',
                    'purchase_number'   => config('settings.level.BRONZE'),
                ],
                [
                    'name_en'              => 'SILVER',
                    'name_ar'           => 'فضي',
                    'purchase_number'   => config('settings.level.SILVER'),
                ],
                [
                    'name_en'              => 'GOLD',
                    'name_ar'           => 'ذهبي',
                    'purchase_number'   => config('settings.level.GOLD'),
                ],
                [
                    'name_en'              => 'PLATINUM',
                    'name_ar'           => 'بلاتيني',
                    'purchase_number'   => config('settings.level.PLATINUM'),
                ]
            ]
        );
    }
}
