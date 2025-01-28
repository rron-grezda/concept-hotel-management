<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            App::setLocale(auth()->user()->locale);
        } 
        elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
