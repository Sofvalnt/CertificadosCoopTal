@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@push('css')
<style>
    body.login-page {
        background: url('{{ asset("vendor/adminlte/dist/img/alerta.png") }}') no-repeat center center fixed;
        background-size: cover;
    }

    .auth-box {
        background-color: rgba(0, 0, 0, 0.75);
        color: #f1f1f1;
        border: 1px solid #dc3545;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 0 25px rgba(220, 53, 69, 0.3);
    }

    .logo-it {
        font-weight: bold;
        font-size: 1.2rem;
        color: #ffc107; /* dorado tenue */
        margin-bottom: 10px;
    }

    .auth-title {
        font-weight: bold;
        font-size: 1.3rem;
        color: #dc3545; /* rojo suave */
        margin-bottom: 5px;
    }

    .auth-subtitle {
        font-size: 0.95rem;
        color: #ccc;
        margin-bottom: 25px;
    }

    .restricted-alert {
        background-color: #212529;
        color: #f8d7da;
        border-left: 4px solid #dc3545;
        padding: 10px 15px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        border-radius: 4px;
    }

    .btn-danger-auth {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@endpush

@section('auth_header')
    <div class="text-center auth-title">
        ACCESO RESTRINGIDO
    </div>
    <div class="text-center auth-subtitle">
        Cooperativa de Ahorro y Crédito "TALANGA" LTDA.
    </div>
@endsection

@section('auth_body')
    <div class="auth-box">
        <div class="restricted-alert">
            <strong>Advertencia:</strong> Solo personal autorizado puede continuar. Este módulo es exclusivo para el departamento de IT o personas validadas.
        </div>

        <form method="POST" action="{{ route('verificar-registro') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="password" name="clave" class="form-control @error('clave') is-invalid @enderror"
                    placeholder="Contraseña de acceso" autofocus>

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock text-danger"></span>
                    </div>
                </div>

                @error('clave')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger btn-block btn-danger-auth">
                <span class="fas fa-shield-alt"></span> Ingresar al Área Restringida
            </button>
        </form>
    </div>
@endsection

@section('auth_footer')
    <p class="my-2 text-center">
        <a class="text-light" href="{{ route('login') }}">
            ← Volver al inicio de sesión
        </a>
    </p>
@endsection