<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Cookie;
use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();
            return response()->json([ 'success' => true, 'data' => $user], 200);
        } catch ( \Exception $e ) {
            DB::rollBack();
            var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json([ 'success' => false ], 500);
        }
    }

    public function login( Request $request )
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) ) {
                if ( !$token = JWTAuth::attempt($credentials) ) {
                    return response()->json([
                        'response' => 'error',
                        'message'  => 'invalid_email_or_password',
                    ], 401);
                } else {
                    return response()->json([
                        'response' => 'success',
                        'result'   => [
                            'token' => $token,
                        ],
                    ])->withCookie('token', $token, null, null, null, false, false);

                }
            } else {
                return response()->json([
                    'success' => false,
                    'message'  => 'user_unverified',
                ], 401);
            }
        } catch ( JWTException $e ) {
            return response()->json([
                'success' => false,
                'message'  => 'failed_to_create_token',
            ], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);

            return response()->json([ 'success' => true ], 200)->withCookie(Cookie::forget('token'));
        } catch ( JWTException $e ) {
            // something went wrong whilst attempting to encode the token
            return response()->json([ 'success' => false, 'error' => 'Failed to logout, please try again.' ], 500);
        }
    }

    public function get_auth_user( Request $request )
    {
        try {
            $token = $request->cookie('token');
            $user = JWTAuth::toUser($token);

            return response()->json([ 'data' => $user ], 200);
        } catch ( \Exception $e ){
            var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json([ 'success' => false ], 500);
        }
    }

    public function validate_cookie(Request $request)
    {
        try {
            $token = $request->cookie('token');
            $jwt = JWTAuth::parseToken($token)->authenticate();
            $user = Auth::user()->where('email', $jwt->email)->firstOrFail();

            if($user) {
                return response()->json([ 'success' => true ], 200);
            }
        } catch ( \Exception $e){
            return response()->json([ 'success' => false ], 500);
        }
    }
}
