<?php

namespace App\Http\Middleware;

use App\Http\Requests\user\RegisterUserRequest;
use Closure;
use Illuminate\Http\Request;

class DetectLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        app()->setLocale(in_array($request->route('lang'), ['ar', 'en']) ? $request->route('lang') : 'en');

        return $next($request);
    }
}
