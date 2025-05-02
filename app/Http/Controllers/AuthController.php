<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Maneja la autenticación del usuario.
     */
    public function authenticate(Request $request)
    {
        // Validar credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Autenticar usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar si el usuario tiene 'force_password_change' en 1
            if ($user->force_password_change == 1) {
                // Redirigir a la página de cambio de contraseña
                return redirect()->route('first-login');
            }

            // Si no es necesario el cambio de contraseña, redirigir al dashboard
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
