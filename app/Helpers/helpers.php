<?php

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

if (!function_exists('handle_exception')) {

    function handle_exception($request, $exception)
    {

        return (new \App\Helpers\Exceptions($request, $exception))->report();
    }
}
if (!function_exists('generateKey')) {

    function generateKey()
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $current_date_time = str_replace([' ', ':', '-'], '', $current_date_time);
        $current_date_time = rand(100000, 999999) . "-" . substr($current_date_time, 8, 5) . "-" . substr($current_date_time, 13, 2);

        return  \Str::upper(\Str::random(1)) . '-' . $current_date_time;
    }
}
if (!function_exists('defaultImage')) {

    function defaultImage()
    {
        return 'image';
    }
}

if (!function_exists('getCurrency')) {

    function getCurrency($currency = 'aed')
    {

        if (app()->getLocale() == 'ar') {
            return  Config::get('currencies')->where('code', $currency)[0]->name_ar;
        }
        return $currency;
    }
}

if (!function_exists('transNumber')) {

    function transNumber($value)
    {
        if (app()->getLocale() == 'ar') {
            $arabic_numbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
            $english_numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            return str_replace($english_numbers, $arabic_numbers, $value);
        }
        return $value;
    }
}
