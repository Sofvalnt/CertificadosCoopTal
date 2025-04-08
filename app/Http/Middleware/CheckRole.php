<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    
    public function handle($request, Closure $next, $role)
{
    if (auth()->user()->role !== $role) { // Asume que hay un campo 'role' en la tabla users
        abort(403, 'Acceso no autorizado');
    }
    return $next($request);
}
}
