<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDoctorApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $doctor = auth('doctor')->user();
        if (! $doctor || ! $doctor->isApproved()) {
            auth('doctor')->logout();
            return redirect()->route('dashboard.login')->withErrors([
                'email' => __('translate.doctor_pending_approval'),
            ]);
        }

        return $next($request);
    }
}
