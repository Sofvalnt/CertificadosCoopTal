<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class FirstLoginController extends Controller
{
    /**
     * Muestra el formulario de cambio de contraseña obligatorio
     */
    public function showFirstLoginForm()
    {
        $user = Auth::user();
        
        // Redirige si no requiere cambio de contraseña
        if (!$user->is_first_login && !$user->force_password_change) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.first-login', [
            'is_temporary' => $user->force_password_change
        ]);
    }

    /**
     * Procesa el cambio de contraseña
     */
    public function processFirstLogin(Request $request)
    {
        $user = Auth::user();
        
        // Reglas de validación
        $rules = [
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ];

        // Si es un cambio forzado (no primer login), validar contraseña temporal
        if ($user->force_password_change) {
            $rules['current_password'] = [
                'required',
                function ($attr, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('La contraseña temporal es incorrecta');
                    }
                }
            ];
        }

        // Validar los datos del formulario
        $validated = $request->validate($rules);

        // Actualizar la contraseña y estados del usuario
        $user->update([
            'password' => Hash::make($validated['new_password']),
            'force_password_change' => false,
            'is_first_login' => false,
            'password_changed_at' => now()
        ]);

        // Redirigir al dashboard con mensaje de éxito
        return redirect()->route('dashboard')
               ->with('success', 'Contraseña actualizada correctamente');
    }
}