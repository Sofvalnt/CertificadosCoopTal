<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class ITController extends Controller
{
    /**
     * Muestra el formulario para restablecer contraseñas
     */
    public function showResetForm()
    {
        return view('it.password-reset', [
            'users' => User::orderBy('name')->get() // Opcional: Lista de usuarios para seleccionar
        ]);
    }

    /**
     * Procesa el restablecimiento de contraseña por parte de IT
     */
    public function resetPassword(Request $request)
    {
        // Validación de datos mejorada
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'temp_password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
        ]);

        try {
            // Busca al usuario por ID (más seguro que por email)
            $user = User::findOrFail($validated['user_id']);
            
            // Verifica que no sea la misma contraseña actual
            if (Hash::check($validated['temp_password'], $user->password)) {
                return back()->with('error', 'La nueva contraseña no puede ser igual a la actual.');
            }

            // Actualiza con contraseña temporal
            $user->update([
                'password' => Hash::make($validated['temp_password']),
                'force_password_change' => true,  // Obliga a cambiar en próximo login
                'is_first_login' => false,        // No es primer acceso
                'password_changed_at' => null     // Resetear fecha de cambio
            ]);

            // Registro de actividad
            Log::channel('it_actions')->info("Contraseña restablecida por IT para el usuario {$user->email}", [
                'action_by' => auth()->user()->email,
                'user_affected' => $user->email
            ]);

            // Opcional: Enviar notificación al usuario

            return back()->with('success', 'Contraseña temporal asignada. El usuario deberá cambiarla al ingresar.');

        } catch (\Exception $e) {
            Log::channel('it_actions')->error("Error al restablecer contraseña: " . $e->getMessage(), [
                'action_by' => auth()->user()->email,
                'request_data' => $request->all()
            ]);
            
            return back()->with('error', 'Ocurrió un error. Por favor intente nuevamente.');
        }
    }
}