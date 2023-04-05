<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
        //agar user oon roli ke sakhti ro nadasht
        if (!$request->user()->userHasRole($role))
        {//ma in ra be rout ezafe mikonim
            abort(403,'you ar not authorized');

        }
        return $next($request);

    }
}
