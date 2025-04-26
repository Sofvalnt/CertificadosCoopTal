<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRegistro
{
    public function handle(Request $request, Closure $next)
    {
        // Si estás intentando entrar a /register sin tener la clave verificada, redirige
        if ($request->is('register') && !session()->get('clave_verificada')) {
            return redirect()->route('verificar-registro')->withErrors(['clave' => 'Debes verificar el acceso.']);
        }

        return $next($request);
    }
}
