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

        if ($user && ($user->is_first_login || $user->force_password_change)) {

            // Usa los NOMBRES de las rutas
            $allowedRouteNames = ['first-login', 'logout', 'password.change.form', 'password.change'];

            // Si no es una de las rutas permitidas, redirige
            if (!in_array($request->route()->getName(), $allowedRouteNames)) {
                return redirect()->route('first-login');
            }
        }

        return $next($request);
    }
}
