<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AjustesController;
use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ITController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\CertificadoController;

// Rutas públicas (sin autenticación)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);

    // Mostrar formulario para ingresar contraseña
    Route::get('/verificar-registro', [RegistroController::class, 'verificarForm'])->name('verificar-registro');

    // Procesar contraseña de verificación
    Route::post('/verificar-registro', [RegistroController::class, 'verificarPassword'])->name('verificar-registro.post');

    // Formulario de registro (protegido por middleware)
    Route::get('/register', [RegistroController::class, 'registerForm'])->middleware('check.registro')->name('register');

    // Procesar registro (protegido también)
    Route::post('/register', [RegistroController::class, 'registerUser'])->middleware('check.registro');
});

// Rutas protegidas (requieren autenticación)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/first-login', [FirstLoginController::class, 'showFirstLoginForm'])->name('first-login');
    Route::post('/first-login', [FirstLoginController::class, 'processFirstLogin'])->name('first-login.process');

    Route::view('/welcome', 'welcome')->name('welcome');
    Route::view('/generador', 'generador')->name('generador');
    Route::view('/juventud', 'juventud')->name('juventud');
    Route::view('/educacion', 'educacion')->name('educacion');
    Route::view('/general', 'general')->name('general');
    Route::view('/genero', 'genero')->name('genero');
    Route::view('/generacion', 'generacion')->name('generacion');
    Route::view('/reconocimiento', 'reconocimiento')->name('reconocimiento');
    Route::view('/participacion', 'participacion')->name('participacion');
    Route::view('/generacionCertificados', 'generacionCertificados')->name('generacionCertificados');
    Route::view('/perfil', 'profile.show')->name('perfil');

    // Ajustes
    Route::prefix('ajustes')->group(function () {
        Route::get('/', [AjustesController::class, 'index'])->name('ajustes');
        Route::post('/update-password', [AjustesController::class, 'updatePassword'])->name('ajustes.update-password');
    });

    // Cambio obligatorio de contraseña
    Route::get('/password-change', [PasswordController::class, 'showChangeForm'])->name('password.change.form');
    Route::post('/password-change', [PasswordController::class, 'changePassword'])->name('password.change');

    // Ruta para mostrar el perfil del usuario autenticado
    Route::get('/mi-perfil', function () {
        return view('profile.show', ['user' => Auth::user()]);
    })->name('mi-perfil');
});

// Rutas para IT
Route::middleware(['auth', 'check.role:it'])->group(function () {
    Route::get('/it/password-reset', [ITController::class, 'showPasswordResetForm'])->name('it.password.reset');
    Route::post('/it/password-reset', [ITController::class, 'resetPassword']);
});

// Descargar plantilla CSV
Route::get('/descargar-plantilla', function () {
    return response()->download(
        storage_path('app/public/vendor/adminlte/dist/img/Plantilla_Diploma.csv'),
        'Plantilla_Diploma.csv'
    );
});

// Ruta para generar QR
Route::post('/generar-qr', [DiplomaController::class, 'generarQR'])->name('generar.qr');

// Ruta para verificar código QR
Route::get('/verificar/{codigo}', [DiplomaController::class, 'verificar'])->name('verificar.diploma');

// Ruta para generar certificado
Route::post('/generar-certificado', [CertificadoController::class, 'generarCertificado'])->name('generar.certificado');


// Ruta para verificar la contraseña antes de registrar
Route::get('/verificar-registro', [RegistroController::class, 'verificarForm'])->name('verificar-registro');

// Ruta para procesar la contraseña
Route::post('/verificar-registro', [RegistroController::class, 'verificarPassword'])->name('verificar-registro.post');

// Ruta de registro con el middleware 'check.registro'
Route::get('/register', [RegistroController::class, 'registerForm'])
    ->middleware('check.registro') // Aquí se aplica el middleware para bloquear el acceso forzado
    ->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegistroController::class, 'registerUser'])
    ->middleware('check.registro') // Aquí también se aplica el middleware
    ->name('register');
    Route::get('/register', [RegistroController::class, 'registerForm'])->middleware('check.registro')->name('register');




Route::get('/verificar-registro', [RegistroController::class, 'verificarForm'])->name('verificar-registro');
Route::post('/verificar-registro', [RegistroController::class, 'verificarPassword'])->name('verificar-password');

Route::get('/register', [RegistroController::class, 'registerForm'])
    ->middleware('check.registro') // <--- Protegido aquí
    ->name('register');

    Route::get('/register', [RegistroController::class, 'registerForm'])->name('register');
Route::post('/register', [RegistroController::class, 'registerUser'])->name('register.submit');

Route::get('/firstlogin', [FirstLoginController::class, 'index'])->name('firstlogin');

Route::get('/first-login', function () {
    return view('auth.first-login');
})->name('first-login');

// Ruta para mostrar el formulario de cambio de contraseña obligatorio
Route::get('/first-login', [FirstLoginController::class, 'showFirstLoginForm'])->name('first-login');

// Ruta para procesar el cambio de contraseña
Route::post('/first-login', [FirstLoginController::class, 'processFirstLogin'])->name('first.login.process');