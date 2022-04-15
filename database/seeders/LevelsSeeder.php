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
                    'name'              => 'BRONZE',
                    'name_en'           => 'برونزي',
                    'purchase_number'   => config('settings.level.BRONZE'),
                ],
                [
                    'name'              => 'SILVER',
                    'name_en'           => 'فضي',
                    'purchase_number'   => config('settings.level.SILVER'),
                ],
                [
                    'name'              => 'GOLD',
                    'name_en'           => 'ذهبي',
                    'purchase_number'   => config('settings.level.GOLD'),
                ],
                [
                    'name'              => 'PLATINUM',
                    'name_en'           => 'بلاتيني',
                    'purchase_number'   => config('settings.level.PLATINUM'),
                ]
            ]
        );
    }
}
