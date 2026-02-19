<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfDashboardAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin')->check()) {
            return redirect()->route('dashboard.home');
        }

        if (auth('doctor')->check() && auth('doctor')->user()->isApproved()) {
            return redirect()->route('doctor.home');
        }

        return $next($request);
    }
}
