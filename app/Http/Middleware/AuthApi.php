<?php

namespace App\Http\Middleware;

use Closure;

class AuthApi
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
        $key = "abcd1234";
        if ($request->header('key') != $key) {
            $response = [
                'status' => 401,
                'message' => 'Unauthorized',
            ];
            return response()->json($response, 413);
        } else {
            return $next($request);
        }

    }
}
