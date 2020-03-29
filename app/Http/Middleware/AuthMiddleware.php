<?php

namespace App\Http\Middleware; 
use Auth;
use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class AuthMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([ 'message' => 'Token không hợp lệ', 'status' => 401 ], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['message' => 'Token hết hạn',  'status' => 401 ], 401);
            }else{
                return response()->json(['message' => 'Token không tìm thấy', 'status' => 401 ], 401);
            }
        }
        return $next($request); 
    }
}
