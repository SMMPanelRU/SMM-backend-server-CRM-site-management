<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class IsAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request                                                                          $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $team = Team::query()->where('name', 'Administrators')->first();

        if (Auth::check() ) {
            if ( Auth::user()->belongsToTeam($team)) {
                return $next($request);
            }
            return redirect('welcome')->with('error', 'User not found');
        }

        return $next($request);

    }
}
