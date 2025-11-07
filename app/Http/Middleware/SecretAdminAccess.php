<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $secretPrefix = config('app.admin_secret');

        // If no secret prefix is set, deny access
        if (empty($secretPrefix)) {
            abort(404);
        }

        // Check if the request URL starts with the secret prefix
        if (!$request->is($secretPrefix . '/*') && !$request->is($secretPrefix)) {
            abort(404); // Return 404 for non-matching URLs
        }

        return $next($request);
    }
}
