<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
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

        $userLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if(session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            if (in_array($userLang, config('app.locales'))) {
                app()->setLocale($userLang);
            } else {
                app()->setLocale(config('app.locale'));
            }
        }

        return $next($request);
    }
}
