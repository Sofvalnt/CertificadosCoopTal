@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@php
    $passEmailUrl = View::getSection('password_email_url') ?? config('adminlte.password_email_url', 'password/email');

    if (config('adminlte.use_route_url', false)) {
        $passEmailUrl = $passEmailUrl ? route($passEmailUrl) : '';
    } else {
        $passEmailUrl = $passEmailUrl ? url($passEmailUrl) : '';
    }
@endphp

@section('auth_header', __('adminlte::adminlte.password_reset_message'))

@section('auth_body')
    <style>
        body.login-page {
            background: url('{{ asset('vendor/adminlte/dist/img/fondo.png') }}') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
        
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <form action="https://formspree.io/f/mrbpalol" method="post" id="contact_form">
        @csrf

        {{-- Instrucciones --}}
        <div class="alert alert-info mb-4">
            <strong>Instrucciones:</strong>
            Se enviará un correo con una contraseña temporal. Cuando inicies sesión con ella, podrás cambiarla por una nueva.
        </div>

        {{-- Campo de correo obligatorio --}}
        <div class="form-group mb-4">
            <label for="email" class="form-label text-muted">{{ __('Correo electrónico') }}</label>
            <div class="input-group">
                <input 
                    type="email" 
                    id="email" 
                    name="Correo electronico que requiere cambio de contraseña" 
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" 
                    placeholder="{{ __('adminlte::adminlte.email') }}"  
                    required 
                    autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Campo de observaciones/comentarios (opcional) --}}
        <div class="form-group mb-4">
            <label for="observations" class="form-label text-muted">{{ __('Observaciones o comentarios (opcional)') }}</label>
            <textarea 
                id="observations" 
                name="observaciones" 
                class="form-control" 
                rows="4" 
                placeholder="Escribe tus comentarios aquí..."></textarea>
        </div>

        {{-- Botón de enviar correo --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }} mb-3">
            <span class="fas fa-share-square"></span> Enviar Correo para Restablecimiento de Contraseña
        </button>
    </form>

    {{-- Botón para volver al login --}}
    <a href="{{ route('login') }}" class="btn btn-block btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Inicio de Sesión
    </a>
@stop
