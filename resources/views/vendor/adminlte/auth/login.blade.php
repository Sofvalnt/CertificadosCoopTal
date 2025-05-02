<?php
session()->forget('clave_verificada');
?>


@extends('adminlte::auth.auth-page', ['authType' => 'login'])
@if(session('register_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('register_success.title') }}</strong><br>
        {{ session('register_success.message') }}<br>
        <small>Correo: <em>{{ session('register_success.email') }}</em></small>
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@push('css')

    <style>
        body.login-page {
            background: url('{{ asset('vendor/adminlte/dist/img/fondo.png') }}') no-repeat center center fixed;
            background-size: cover;
        }
        
        /* Animaciones personalizadas */
        @keyframes bounceIn {
          from, 20%, 40%, 60%, 80%, to {
            animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
          }
          0% {
            opacity: 0;
            transform: scale3d(.3, .3, .3);
          }
          20% {
            transform: scale3d(1.1, 1.1, 1.1);
          }
          40% {
            transform: scale3d(.9, .9, .9);
          }
          60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
          }
          80% {
            transform: scale3d(.97, .97, .97);
          }
          to {
            opacity: 1;
            transform: scale3d(1, 1, 1);
          }
        }

        @keyframes fadeOutRight {
          from {
            opacity: 1;
          }
          to {
            opacity: 0;
            transform: translate3d(100%, 0, 0);
          }
        }

        .animated {
          animation-duration: 0.75s;
          animation-fill-mode: both;
        }

        .bounceIn {
          animation-name: bounceIn;
        }

        .fadeOutRight {
          animation-name: fadeOutRight;
        }
        
        /* Estilo del mensaje de éxito */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-left: 5px solid #28a745;
            display: flex;
            align-items: center;
            background: white;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .success-notification .icon-container {
            font-size: 2rem;
            margin-right: 15px;
            color: #28a745;
            padding: 15px;
            background: rgba(40, 167, 69, 0.1);
        }
        
        .success-notification .content {
            flex-grow: 1;
            padding: 10px 15px 10px 0;
        }
        
        .success-notification h5 {
            margin-bottom: 5px;
            font-weight: 600;
            color: #155724;
        }
        
        .success-notification p {
            margin-bottom: 0;
            color: #155724;
        }
        
        .success-notification .close {
            align-self: flex-start;
            padding: 10px;
            color: #155724;
            opacity: 0.8;
        }
        
        .success-notification .close:hover {
            opacity: 1;
        }
    </style>
@endpush

@php
    $loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
    $registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
    $passResetUrl = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');

    if (config('adminlte.use_route_url', false)) {
        $loginUrl = $loginUrl ? route($loginUrl) : '';
        $registerUrl = $registerUrl ? route($registerUrl) : '';
        $passResetUrl = $passResetUrl ? route($passResetUrl) : '';
    } else {
        $loginUrl = $loginUrl ? url($loginUrl) : '';
        $registerUrl = $registerUrl ? url($registerUrl) : '';
        $passResetUrl = $passResetUrl ? url($passResetUrl) : '';
    }
@endphp

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    @if(session('success'))
        <div class="success-notification animated bounceIn" id="successAlert">
            <div class="icon-container">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="content">
                <h5>¡Éxito!</h5>
                <p>{{ session('success') }}</p>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ $loginUrl }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


           {{-- Terms checkbox --}}
           <div class="form-group mb-3">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="terms" id="terms" class="custom-control-input @error('terms') is-invalid @enderror" required>
        <label class="custom-control-label" for="terms">
            Acepto los <a href="\vendor\adminlte\dist\img\TerminosyCondiciones.pdf" target="_blank">términos y condiciones</a>
        </label>
        @error('terms')
        <span class="invalid-feedback" style="display: block;">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

       
            <div class="col-5">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    @if(Route::has('password.request'))
        <p class="my-0">
            <a class="text-success" href="{{ route('password.request') }}">
                {{ __('adminlte::adminlte.i_forgot_my_password') }}
            </a>
        </p>
    @endif

    {{-- Register link --}}
    @if($registerUrl)
        <p class="my-0">
            <a class="text-success" href="{{ route('verificar-registro') }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@stop

@push('js')
<script>
    $(document).ready(function(){
        // Cierre automático mejorado
        if ($('#successAlert').length) {
            setTimeout(function(){
                $('#successAlert').addClass('animated fadeOutRight');
                setTimeout(function(){
                    $('#successAlert').remove();
                }, 750);
            }, 5000);
        }
        
        // Cierre manual con mejor animación
        $('[data-dismiss="alert"]').on('click', function(){
            $(this).closest('.success-notification').addClass('animated fadeOutRight');
            setTimeout(function(){
                $(this).closest('.success-notification').remove();
            }, 750);
        });
    });
</script>
@endpush