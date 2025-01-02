<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$requirements
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$requirements)
    {
        $user = auth()->user();

        // Validasi login
        if (!$user) {
            return redirect('/login');
        }

        // Ekstrak role dan kelompok yang diperbolehkan dari parameter middleware
        [$roles, $kelompoks] = array_pad($requirements, 2, null);

        $allowedRoles = $roles ? explode('|', $roles) : [];
        $allowedKelompoks = $kelompoks ? explode('|', $kelompoks) : [];

        // Validasi role
        if (!empty($allowedRoles) && !in_array($user->jobdesks->role, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Validasi kelompok
        if (!empty($allowedKelompoks) && !in_array($user->kelompok, $allowedKelompoks)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}