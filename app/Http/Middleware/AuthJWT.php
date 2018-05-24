<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class AuthJWT extends BaseMiddleware
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
        $token = $request->cookie('token');
        if ( $token == null ) {
            return redirect('/', 200);
        } else {
            try {
                $user = $this->auth->parseToken($token)->authenticate();
                if ( $user ) {
                    return $next($request);
                } else {
                    return redirect('/');
                }
            } catch(TokenExpiredException $e) {
                return response()->json(['error' => 'token_expired'], 401);
            } catch (TokenInvalidException $e ) {
                return response()->json(['error' => 'token_invalid'], 401);
            } catch ( JWTException $e ) {
                return response()->json(['error' => 'token_absent'], 403);
            }
        }
    }
}
