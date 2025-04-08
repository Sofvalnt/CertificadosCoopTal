<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas (sin autenticación)
Route::middleware('guest')->group(function () {
    // Ruta de login (única definición)
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'authenticate']);
    
    // Ruta de registro
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Rutas protegidas (requieren autenticación)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'force.password.change'
])->group(function () {
    
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Flujo de primer login
    Route::get('/first-login', [FirstLoginController::class, 'showFirstLoginForm'])
         ->name('first-login')
         ->withoutMiddleware('force.password.change');
         
    Route::post('/first-login', [FirstLoginController::class, 'processFirstLogin'])
         ->name('first-login.process');
    
    // Otras páginas protegidas
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    
    Route::get('/generador', function () {
        return view('generador');
    })->name('generador');

    Route::get('/juventud', function () {
        return view('juventud');
    })->name('juventud');

    Route::get('/educacion', function () {
        return view('educacion');
    })->name('educacion');

    Route::get('/general', function () {
        return view('general');
    })->name('general');

    Route::get('/genero', function () {
        return view('genero');
    })->name('genero');

    Route::get('/generacion', function () {
        return view('generacion');
    })->name('generacion');

    // Perfil
    Route::get('/perfil', function () {
        return view('profile.show');
    })->name('perfil');
    
    // Ajustes
    Route::prefix('ajustes')->group(function () {
        Route::get('/', [AjustesController::class, 'index'])->name('ajustes');
        Route::post('/update-password', [AjustesController::class, 'updatePassword'])
             ->name('ajustes.update-password');
    });
    
    // Logout
    Route::post('logout', function (Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Ruta protegida SOLO para IT
Route::middleware(['auth', 'check.role:it'])->group(function () {
    Route::get('/it/password-reset', [ITController::class, 'showPasswordResetForm'])->name('it.password.reset');
    Route::post('/it/password-reset', [ITController::class, 'resetPassword']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/password-change', [PasswordController::class, 'showChangeForm'])
         ->name('password.change.form');
         
    Route::post('/password-change', [PasswordController::class, 'changePassword'])
         ->name('password.change');
});

// Rutas para IT
Route::prefix('it')->middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/password-reset', [ITController::class, 'showResetForm'])
         ->name('it.password.reset');
         
    Route::post('/password-reset', [ITController::class, 'resetPassword'])
         ->name('it.password.reset.submit');
});

// Rutas para cambio obligatorio
Route::middleware(['auth', 'force.password.change'])->group(function () {
    Route::get('/first-login', [FirstLoginController::class, 'showFirstLoginForm'])
         ->name('first-login')
         ->withoutMiddleware('force.password.change');
         
    Route::post('/first-login', [FirstLoginController::class, 'processFirstLogin'])
         ->name('first-login.submit')
         ->withoutMiddleware('force.password.change');
});

Route::get('/descargar-plantilla', function () {
    return response()->download(
        storage_path('app/public/vendor\adminlte\dist\img\Plantilla_Diploma.csv'),
        'Plantilla_Diploma.csv'  // Nombre personalizado al descargar
    );
});