<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistro
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si la clave ha sido verificada en la sesión
        if (!session()->has('clave_verificada')) {
            // Si no está verificada, redirige al formulario de verificación
            return redirect()->route('verificar-registro')->withErrors(['clave' => 'Debes verificar el acceso.']);
        }

        // Si la clave está verificada, continúa con la solicitud
        return $next($request);
    }
}
