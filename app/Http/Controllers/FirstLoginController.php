<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FirstLoginController extends Controller
{
    /**
     * Show mandatory password change form
     */
    public function showFirstLoginForm()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Por favor inicie sesión primero');
        }
        
        if (!$this->requiresPasswordChange($user)) {
            return redirect()->route('dashboard')
                   ->with('info', 'No se requiere cambio de contraseña en este momento');
        }
        
        return view('auth.first-login', [
            'is_temporary' => $user->force_password_change
        ]);
    }

    /**
     * Process password change
     */
    public function processFirstLogin(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Usuario no autenticado');
        }

        // Validate if password change is really needed
        if (!$this->requiresPasswordChange($user)) {
            return redirect()->route('dashboard')
                   ->with('error', 'No se requiere cambio de contraseña');
        }

        // Validation rules
        $rules = [
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'different:current_password'
            ],
            'current_password' => [
                'required',
                function ($attr, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('La contraseña actual no es correcta');
                    }
                }
            ]
        ];

        $validated = $request->validate($rules);

        try {
            $user->update([
                'password' => Hash::make($validated['new_password']),
                'force_password_change' => false,
                'is_first_login' => false,
                'password_changed_at' => now()
            ]);

            Auth::logoutOtherDevices($validated['new_password']);

            return redirect()->route('dashboard')
                   ->with('success', 'Contraseña actualizada correctamente. ¡Bienvenido!');

        } catch (\Exception $e) {
            return back()
                   ->withInput()
                   ->with('error', 'Ocurrió un error al actualizar la contraseña: '.$e->getMessage());
        }
    }

    /**
     * Check if user requires password change
     */
    protected function requiresPasswordChange(User $user): bool
    {
        // Verifica si el usuario requiere el cambio de contraseña
        return $user->force_password_change || $user->is_first_login;
    }
}
