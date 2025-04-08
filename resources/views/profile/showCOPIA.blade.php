@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1><center>Perfil del usuario</h1>
    <p>A continuacion podra sver toda la informacion de tu perfil, asi com se podra modificar cualquier tipo de dato</p></center>
@stop


@section('content')
<x-app-layout>
    {{-- Layout base de la aplicación. Este componente define la estructura general de la página. --}}

    <div>
        {{-- Contenedor principal para el contenido de la página. --}}
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- Contenedor con un ancho máximo de 7xl, centrado y con padding. --}}

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                {{-- Verifica si la función de actualización de información del perfil está habilitada. --}}
                @livewire('profile.update-profile-information-form')
                {{-- Incluye el formulario Livewire para actualizar la información del perfil. --}}

                <x-section-border />
                {{-- Línea divisoria entre secciones. --}}
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                {{-- Verifica si la función de actualización de contraseña está habilitada. --}}
                <div class="mt-10 sm:mt-0">
                    {{-- Contenedor con margen superior. --}}
                    @livewire('profile.update-password-form')
                    {{-- Incluye el formulario Livewire para actualizar la contraseña. --}}
                </div>

                <x-section-border />
                {{-- Línea divisoria entre secciones. --}}
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                {{-- Verifica si la función de autenticación de dos factores está habilitada. --}}
                <div class="mt-10 sm:mt-0">
                    {{-- Contenedor con margen superior. --}}
                    @livewire('profile.two-factor-authentication-form')
                    {{-- Incluye el formulario Livewire para gestionar la autenticación de dos factores. --}}
                </div>

                <x-section-border />
                {{-- Línea divisoria entre secciones. --}}
            @endif

            <div class="mt-10 sm:mt-0">
                {{-- Contenedor con margen superior. --}}
                @livewire('profile.logout-other-browser-sessions-form')
                {{-- Incluye el formulario Livewire para cerrar sesiones en otros navegadores. --}}
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                {{-- Verifica si la función de eliminación de cuenta está habilitada. --}}
                <x-section-border />
                {{-- Línea divisoria entre secciones. --}}

                <div class="mt-10 sm:mt-0">
                    {{-- Contenedor con margen superior. --}}
                    @livewire('profile.delete-user-form')
                    {{-- Incluye el formulario Livewire para eliminar la cuenta de usuario. --}}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
@stop