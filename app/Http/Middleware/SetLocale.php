<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->locale, config('app.locales'))) {
            app()->setLocale($request->locale);
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }
        
        return $next($request);
    }
}
