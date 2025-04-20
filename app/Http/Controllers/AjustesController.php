<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AjustesController extends Controller
{
    // Muestra formulario de primer login
    public function showFirstLoginForm()
    {
        if (!auth()->user()->is_first_login) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.first-login');
    }

    // Procesa primer login
    public function processFirstLogin(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => ['required', function ($attr, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('La contraseña temporal es incorrecta');
                }
            }],
            'new_password' => 'required|min:8|confirmed|different:current_password'
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
            'is_first_login' => false,
            'password_changed_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Contraseña actualizada correctamente');
    }

    // Panel de ajustes normal
    public function index()
    {
        return view('auth.first-login');
    }

    // Cambio de contraseña normal
    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => ['required', function ($attr, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('La contraseña actual es incorrecta');
                }
            }],
            'new_password' => 'required|min:8|confirmed'
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
            'password_changed_at' => now()
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente');
    }
}