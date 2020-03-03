<?php

namespace App\Http\Middleware; 
use Auth;
use Closure;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        // if (JWTAuth::getToken() && JWTAuth::parseToken()->authenticate()) {
        //     $user = JWTAuth::parseToken()->authenticate();
        // } else {
        //     return response()->json(['error' => 'user_not_found'], 404);
        // }
        // return $next($request);
        dd(Auth());
    }
}
