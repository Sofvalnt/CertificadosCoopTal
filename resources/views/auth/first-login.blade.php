@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('Cambio de Contraseña Obligatorio'))

@section('auth_body')
    <div class="alert alert-warning">
        <i class="icon fas fa-exclamation-triangle"></i>
        @if($is_temporary)
            Por seguridad, debe cambiar su contraseña temporal para continuar
        @else
            Es su primer acceso. Por favor establezca una nueva contraseña segura
        @endif
    </div>

    <form method="POST" action="{{ route('first.login.process') }}" id="passwordForm">
        @csrf
        
        @if($is_temporary)
        <!-- Contraseña Temporal (solo para cambios forzados) -->
        <div class="input-group mb-3">
            <input type="password" name="current_password" 
                   class="form-control @error('current_password') is-invalid @enderror"
                   placeholder="{{ __('Contraseña Temporal') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('current_password') }}</strong>
                </span>
            @enderror
        </div>
        @endif

        <!-- Nueva Contraseña -->
        <div class="input-group mb-3">
            <input type="password" name="new_password" id="new_password"
                   class="form-control @error('new_password') is-invalid @enderror"
                   placeholder="{{ __('Nueva Contraseña') }}" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{10,}"
                   title="Mínimo 10 caracteres con mayúsculas, números y símbolos">
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
        <div class="input-group mb-4">
            <input type="password" name="new_password_confirmation"
                   class="form-control"
                   placeholder="{{ __('Confirmar Nueva Contraseña') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <!-- Indicador de fortaleza de contraseña -->
        <div class="password-strength mb-3">
            <div class="progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>
            <small class="form-text text-muted">
                La contraseña debe contener al menos:
                <ul>
                    <li>10 caracteres</li>
                    <li>1 letra mayúscula</li>
                    <li>1 letra minúscula</li>
                    <li>1 número</li>
                    <li>1 carácter especial</li>
                </ul>
            </small>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('Guardar Nueva Contraseña') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Botón para cerrar sesión -->
    <div class="mt-3 text-center">
        <button class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-1"></i> Cerrar Sesión
        </button>
    </div>

    <!-- Formulario oculto para logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Control de envío del formulario
    let formSubmitted = false;
    
    // Validación de fortaleza de contraseña en tiempo real
    $('#new_password').on('input', function() {
        const password = $(this).val();
        const progress = $('.progress-bar');
        let strength = 0;
        
        // Longitud
        if (password.length >= 10) strength += 25;
        // Mayúsculas
        if (/[A-Z]/.test(password)) strength += 25;
        // Números
        if (/[0-9]/.test(password)) strength += 25;
        // Símbolos
        if (/[\W_]/.test(password)) strength += 25;
        
        // Actualizar barra de progreso
        progress.css('width', strength + '%');
        
        // Cambiar color según fortaleza
        if (strength < 50) {
            progress.removeClass('bg-warning bg-success').addClass('bg-danger');
        } else if (strength < 75) {
            progress.removeClass('bg-danger bg-success').addClass('bg-warning');
        } else {
            progress.removeClass('bg-danger bg-warning').addClass('bg-success');
        }
    });
    
    // Validación de confirmación de contraseña
    $('input[name="new_password_confirmation"]').on('input', function() {
        const password = $('#new_password').val();
        const confirmation = $(this).val();
        
        if (password !== confirmation) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    // Previene que el usuario salga sin cambiar la contraseña
    window.addEventListener('beforeunload', function(e) {
        if (!formSubmitted) {
            e.preventDefault();
            e.returnValue = '¿Estás seguro de querer salir sin cambiar tu contraseña?';
            return e.returnValue;
        }
    });
    
    // Marca el formulario como enviado
    $('#passwordForm').on('submit', function() {
        formSubmitted = true;
    });
});
</script>
<style>
.password-strength .progress {
    height: 5px;
    margin-bottom: 10px;
}
.password-strength .progress-bar {
    transition: width 0.3s ease, background-color 0.3s ease;
}
body.login-page {
    background: url('{{ asset('vendor/adminlte/dist/img/fondo.png') }}') no-repeat center center fixed;
    background-size: cover;
}
</style>
@endsection
