@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('Cambio de Contraseña Obligatorio'))

@section('auth_body')
    <div class="alert alert-warning">
        <i class="icon fas fa-exclamation-triangle"></i>
        Por seguridad, debe cambiar su contraseña temporal para continuar
    </div>

    <form method="POST" action="{{ route('first-login') }}" id="passwordForm">
        @csrf
        
        <!-- Contraseña Temporal -->
        <div class="input-group mb-3">
            <input type="password" name="current_password" 
                   class="form-control @error('current_password') is-invalid @enderror"
                   placeholder="Contraseña Temporal" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Nueva Contraseña -->
        <div class="input-group mb-3">
            <input type="password" name="new_password"
                   class="form-control @error('new_password') is-invalid @enderror"
                   placeholder="Nueva Contraseña" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div class="input-group mb-3">
            <input type="password" name="new_password_confirmation"
                   class="form-control"
                   placeholder="Confirmar Nueva Contraseña" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save mr-2"></i>
                    Guardar Nueva Contraseña
                </button>
            </div>
            <div class="col-md-6 mt-2 mt-md-0">
                <a href="#" class="btn btn-danger btn-block" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </form>

    <!-- Formulario oculto para logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
    // Variable para controlar el envío del formulario
    let formSubmitted = false;

    // Previene que el usuario salga sin cambiar la contraseña
    window.addEventListener('beforeunload', function(e) {
        @if(auth()->check() && auth()->user()->is_first_login)
        if (!formSubmitted) {
            e.preventDefault();
            e.returnValue = '¿Estás seguro de querer salir sin cambiar tu contraseña temporal?';
            return e.returnValue;
        }
        @endif
    });

    // Marca el formulario como enviado cuando se haga submit
    document.getElementById('passwordForm').addEventListener('submit', function() {
        formSubmitted = true;
    });

    <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <!-- Campos de contraseña temporal, nueva y confirmación -->
    <button type="submit">Guardar</button>
</form>
    </script>
@endsection