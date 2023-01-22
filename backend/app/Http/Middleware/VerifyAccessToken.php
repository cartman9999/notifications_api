<?php

namespace App\Http\Middleware;

use App\Models\{User};
use Closure;
use Illuminate\Http\Request;

class VerifyAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrive access token from request header
        $access_token = $request->header('x-access-token');

        // If access token was not provided inside the request header
        if (!$access_token) {
            return response()->json(['message' => 'Forbidden. Please provide a valid access token.'], 403);
        }

        // Check that access token belongs to a user
        if (!User::whereAccessToken($access_token)->first(['id'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
