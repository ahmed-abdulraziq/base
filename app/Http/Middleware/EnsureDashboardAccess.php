<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDashboardAccess
{
    /**
     * لوحة التحكم الرئيسية للأدمن فقط.
     * الطبيب يدخل من لوحة الطبيب /doctor
     */
    public function handle(Request $request, Closure $next): Response
    {
        // منع حلقة التوجيه: لو الطلب لصفحة الدخول أو التسجيل بالضبط لا نطبّق التوجيه
        $path = trim($request->path(), '/');
        if (in_array($path, ['dashboard/login', 'dashboard/register'], true)) {
            return $next($request);
        }

        if (auth('admin')->check()) {
            return $next($request);
        }

        if (auth('doctor')->check() && auth('doctor')->user()->isApproved()) {
            return redirect()->route('doctor.home');
        }

        return redirect()->route('dashboard.login');
    }
}
