<?php
if (!function_exists('handle_exception')) {

    function handle_exception($request, $exception)
    {

        return (new \App\Helpers\Exceptions($request, $exception))->report();
    }
}
