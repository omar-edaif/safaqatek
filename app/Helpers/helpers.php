<?php

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

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
