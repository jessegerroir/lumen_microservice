<?php

namespace App\Http\Middleware;

use Closure;
use Error;
use Illuminate\Http\Response;

class AuthenticateAccess
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Make sure incoming request auth header has accepted secret password present
        if ($request->header('Authorization') == env('APP_KEY')) {
            // Continue request to routing
            return $next($request);
        }

        // Reject request if unauthorized
        abort(Response::HTTP_UNAUTHORIZED);

    }
}
