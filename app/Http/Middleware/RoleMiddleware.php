<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Buat array penampung role milik user
        $userRoles = [$user->role];

        // 2. Optimasi: Hanya cek piket jika role aslinya adalah 'guru'
        // dan pastikan method isPiketToday() memang ada di model User
        if ($user->role === 'guru' && method_exists($user, 'isPiketToday') && $user->isPiketToday()) {
            $userRoles[] = 'piket';
        }

        // 3. Jika user memiliki salah satu dari role yang diizinkan di route
        if (count(array_intersect($userRoles, $roles)) > 0) {
            return $next($request);
        }

        // 4. Jika tidak memiliki akses, lempar ke 403
        abort(403, 'Unauthorized Access.');
    }
}
