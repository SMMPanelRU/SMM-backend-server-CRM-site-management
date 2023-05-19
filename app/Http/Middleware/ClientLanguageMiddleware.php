<?php

namespace App\Http\Middleware;

use App\Services\SiteContainer;
use Closure;
use Illuminate\Http\Request;

class ClientLanguageMiddleware
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

        $siteLocale = app(SiteContainer::class)->getSite();

        if ($siteLocale->lang ?? null) {
            app()->setLocale($siteLocale->lang);
        } else {
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
