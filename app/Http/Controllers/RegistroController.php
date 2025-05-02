<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

class RegistroController extends Controller
{
    /**
     * Muestra el formulario de verificación
     */
    public function verificarForm()
    {
        return view('verificar-registro');
    }

    /**
     * Procesa la contraseña y establece la sesión
     */
    public function verificarPassword(Request $request)
    {
        $request->validate([
            'clave' => 'required|string'
        ]);

        $password = $request->input('clave');
        $contraseñaCorrecta = 'CONTRASEÑA';

        if ($password === $contraseñaCorrecta) {
            $request->session()->put('clave_verificada', true);
            return redirect()->route('register')
                ->with('status', 'Verificación exitosa. Complete el formulario de registro.');
        }

        return back()->withErrors([
            'clave' => 'Contraseña de registro incorrecta.'
        ]);
    }

    /**
     * Muestra el formulario de registro
     */
    public function registerForm(Request $request)
    {
        if (!$request->session()->get('clave_verificada')) {
            return redirect()->route('verificar-registro')
                ->with('info', 'Debe verificar la clave de registro primero');
        }

        return view('auth.register');
    }

    /**
     * Procesa el registro del nuevo usuario y redirige a login
     */
    public function registerUser(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'first_login' => 0,
            'force_password_change' => 1,
        ]);
        

        // Disparar evento de registro (envía email de verificación)
        event(new Registered($user));

        // Limpiar sesión de verificación
        $request->session()->forget('clave_verificada');

        // Redirigir a login con mensaje estructurado
        return redirect()->route('login')
            ->with('register_success', [
                'title' => '¡Registro exitoso!',
                'email' => $validated['name'],
                'icon' => 'success'
            ]);
    }
    
}