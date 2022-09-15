<?php

namespace App\Http\Middleware;

use App\Models\Site;
use App\Services\SiteContainer;
use Closure;
use Illuminate\Http\Request;

class CheckSiteMiddleware
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

        $token = $request->headers->get('X-Client-Token');

        if (empty($token)) {
            abort(response()->json('Unauthorized', 403));
        }

        $site = Site::query()->where('api_key', (string) $token)->first();

        if ($site === null)
        {
            abort(response()->json('Unauthorized', 403));
        }

        app(SiteContainer::class)->setSite($site);

        return $next($request);
    }
}
