<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * API Login
     * 
     * @param Request $request
     * @return Response $response
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Wrong credentials'], 401);       
        }

        return response(Auth::user(), 200);
    }

    /**
     * API Logout
     * 
     * @param Request $request
     * @return Response $response
     */
    public function logout(Request $request) {
        info("Logout");
        info($request->access_token);
        $user = User::whereAccessToken($request->header('x-access-token'))->first();
        $user->update([
                    'access_token' => uniqid('user_', true)
                ]);
        info("Actualiza");
        
        return response(null, 200);
    }
}
