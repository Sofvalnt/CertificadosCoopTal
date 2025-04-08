use Illuminate\Http\Request;

protected function authenticated(Request $request, $user)
{
    // Si nunca ha cambiado la contraseña
    if (!$user->password_changed_at) {
        return redirect()->route('ajustes');
    }

    return redirect()->intended('/dashboard');
}