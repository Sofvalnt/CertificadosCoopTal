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

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="https://formspree.io/f/mrbpalol" method="post" id="contact_form">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="Correo electronico que requiere cambio de contraseña" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}"  required autofocus>

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

        {{-- Send reset link button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-share-square">Enviar Correo para restablecimiento de Contraseña</span>
        </button>
    </form>

@stop
