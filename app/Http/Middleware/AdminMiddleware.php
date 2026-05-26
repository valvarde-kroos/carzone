<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Only allow admin users through.
     * Redirect others to the homepage.
     */
    public function handle(Request $request, Closure $next)
    {
        // User must be logged in AND have role = 'admin'
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
