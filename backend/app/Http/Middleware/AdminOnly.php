<?php

namespace App\Http\Middleware;

use App\Models\{User};
use Closure;
use Illuminate\Http\Request;

class AdminOnly
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

        // Verify if user is admin
        $is_admin = User::whereAccessToken($access_token)
                        ->whereRoleId(1)
                        ->first(['id']);

        if (!$is_admin) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
