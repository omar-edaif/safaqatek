<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelsSeeder::class,
            SettingsSeeder::class,
        ]);
        \App\Models\Slider::factory(3)->create();

        \App\Models\User::factory(10)->create();
        \App\Models\User::create(
            [
                'username' => 'jaafar',
                'phone' => '+9630936950834',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'remember_token' => \Str::random(10),
            ]
        );



        \App\Models\ProductCategories::create(['name_en' => 'motors', 'name_ar' => 'محركات']);

        \App\Models\Product::factory(10)->create();

        $orders = \App\Models\order::factory(10)->create();
        $orders->take(3)->map(function ($order) {
            $order->products()->attach(rand(1, 10), ['quantity' => rand(1, 3)]);
            \App\Models\Coupon::factory(10)->create(['order_id' => $order->id]);
        });

        \App\Models\UserWishlist::factory(10)->create();
        \App\Models\Winner::factory(3)->create();
    }
}
