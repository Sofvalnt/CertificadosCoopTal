<<<<<<< HEAD
use Illuminate\Http\Request;

protected function authenticated(Request $request, $user)
{
    // Si nunca ha cambiado la contraseña
    if (!$user->password_changed_at) {
        return redirect()->route('ajustes');
    }

    return redirect()->intended('/dashboard');
=======
use Illuminate\Http\Request;

protected function authenticated(Request $request, $user)
{
    // Si nunca ha cambiado la contraseña
    if (!$user->password_changed_at) {
        return redirect()->route('ajustes');
    }

    return redirect()->intended('/dashboard');
>>>>>>> 35a042960754fbf6964b47082aa075e639f610b5
}