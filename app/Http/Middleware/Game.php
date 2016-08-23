<?php

namespace App\Http\Middleware;

use Closure;
use App\Control;

class Game
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Control::active()) {
            return redirect('/')->withErrors('Project Omega is momenteel niet actief');
        }
        return $next($request);
    }
}
