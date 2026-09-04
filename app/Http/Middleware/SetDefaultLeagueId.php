<?php

namespace App\Http\Middleware;

use App\Models\League;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultLeagueId
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->missing('league_id')) {
            session()->put('league_id', League::where('name', 'House League')->value('id'));
        }

        return $next($request);
    }
}
