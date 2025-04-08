<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Verificar si el usuario autenticado no ha cambiado su contraseña
        if ($user && !$user->password_changed_at) {
            return redirect()->route('settings'); // Ajusta el nombre de la ruta según tu caso
        }

        return $next($request);
    }
}