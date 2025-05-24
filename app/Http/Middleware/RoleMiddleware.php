<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role; // atau sesuai field role di database

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
