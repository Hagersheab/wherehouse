<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanExporttMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { {
            if (!$request->user()) {
                return redirect()->route('login');
            }
            if ($request->user()->$request->user()->department_id === 5) {
                return $next($request);
            }
            else {
                abort(403, 'ليس لديك صلاحيه للدخول الي هذه الصفحة');
            }

        }
    }
}
