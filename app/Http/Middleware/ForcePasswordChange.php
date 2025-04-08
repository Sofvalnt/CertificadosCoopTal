<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // Verifica si es primer login o si debe forzar cambio
            if ($user->is_first_login == 1 || $user->force_password_change) {
                // Rutas permitidas sin redirección
                $allowedRoutes = ['first-login', 'logout', 'password.change.form', 'password.change'];
                
                if (!$request->is($allowedRoutes)) {
                    return $user->is_first_login == 1 
                        ? redirect()->route('first-login')
                        : redirect()->route('password.change.form');
                }
            }
        }

        return $next($request);
    }
}