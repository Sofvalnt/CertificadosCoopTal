@extends('adminlte::page')

@section('title', 'Perfil de Usuario')

@section('content_header')
    <div class="profile-header">
        <h1 class="text-center"><i class="fas fa-user-circle mr-2"></i>Perfil del Usuario</h1>
        <p class="text-center text-muted">Administra toda tu información personal y configuración de seguridad</p>
    </div>
@stop

@section('content')
<x-app-layout>
    <div class="profile-container">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Menú de navegación del perfil -->
            <div class="profile-nav">
                <a href="#personal-info" class="nav-item active" data-section="personal-info">
                    <i class="fas fa-user mr-2"></i>Información Personal
                </a>
                <a href="#security" class="nav-item" data-section="security">
                    <i class="fas fa-shield-alt mr-2"></i>Seguridad
                </a>
                <a href="#sessions" class="nav-item" data-section="sessions">
                    <i class="fas fa-laptop mr-2"></i>Sesiones
                </a>
                <form method="POST" action="{{ route('logout') }}" class="nav-item logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </button>
                </form>
            </div>

            <!-- Tarjeta de Información del Perfil -->
            <div class="profile-card">
                <!-- Sección de Información Personal -->
                <div class="profile-section active-section" id="personal-info">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="section-content">
                        <h2><i class="fas fa-user-edit mr-2"></i>Información Personal</h2>
                        @livewire('profile.update-profile-information-form')
                    </div>
                    @endif
                </div>

                <!-- Sección de Seguridad -->
                <div class="profile-section" id="security">
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="security-item">
                        <h3><i class="fas fa-key mr-2"></i>Cambiar Contraseña</h3>
                        @livewire('profile.update-password-form')
                    </div>
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="security-item">
                        <h3><i class="fas fa-mobile-alt mr-2"></i>Autenticación de Dos Factores</h3>
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                    @endif
                </div>

                <!-- Sección de Sesiones -->
                <div class="profile-section" id="sessions">
                    <div class="security-item">
                        <h3><i class="fas fa-laptop mr-2"></i>Sesiones Activas</h3>
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="danger-section">
                        <h3><i class="fas fa-exclamation-triangle mr-2"></i>Eliminar Cuenta</h3>
                        @livewire('profile.delete-user-form')
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

@section('css')
<style>
    /* Estilos generales */
    .profile-container {
        background-color: #f8fafc;
        min-height: calc(100vh - 60px);
    }
    
    .profile-header {
        padding: 20px 0;
        background: linear-gradient(135deg, #05846b 25%,rgb(243, 232, 71) 100%);
        color: white;
        margin-bottom: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .profile-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    /* Menú de navegación */
    .profile-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 15px;
    }

    .nav-item:hover, .nav-item.active {
        background: #05846b;
        color: white;
        transform: translateY(-2px);
    }

    .logout-form {
        margin-left: auto;
    }

    .logout-btn {
        background: none;
        border: none;
        color: inherit;
        font: inherit;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
    }

    /* Tarjeta de perfil */
    .profile-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    /* Secciones del perfil */
    .profile-section {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .profile-section.active-section {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .profile-section h2 {
        font-size: 1.8rem;
        color: #2d3748;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }

    /* Items de seguridad */
    .security-item {
        margin-bottom: 30px;
        padding: 25px;
        background: #f7fafc;
        border-radius: 8px;
        border-left: 4px solid #4299e1;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .security-item h3 {
        font-size: 1.3rem;
        color: #4a5568;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    /* Sección de peligro */
    .danger-section {
        background-color: #fff5f5;
        border-left: 4px solid #e53e3e;
    }

    .danger-section h3 {
        color: #e53e3e;
    }

    /* Efectos de hover para botones */
    button:hover {
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-header h1 {
            font-size: 2rem;
        }
        
        .profile-nav {
            flex-direction: column;
        }
        
        .logout-form {
            margin-left: 0;
            margin-top: 10px;
        }
        
        .security-item {
            padding: 15px;
        }
    }
</style>
@endsection

@section('js')
<script>
    // Navegación entre secciones
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if(this.classList.contains('logout-form')) return;
            
            e.preventDefault();
            const sectionId = this.getAttribute('data-section');
            
            // Actualizar navegación activa
            document.querySelectorAll('.nav-item').forEach(navItem => {
                navItem.classList.remove('active');
            });
            this.classList.add('active');
            
            
            // Mostrar sección correspondiente
            document.querySelectorAll('.profile-section').forEach(section => {
                section.classList.remove('active-section');
            });
            document.getElementById(sectionId).classList.add('active-section');
        });
    });

    // Efecto de carga inicial
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.profile-section').classList.add('active-section');
    });

    // Confirmación para cerrar sesión
    document.querySelector('.logout-form').addEventListener('submit', function(e) {
        if(!confirm('¿Estás seguro de que deseas cerrar sesión?')) {
            e.preventDefault();
        }
    });

    // Animaciones para los formularios
    document.addEventListener('livewire:load', function() {
        const sections = document.querySelectorAll('.security-item, .danger-section');
        sections.forEach((section, index) => {
            setTimeout(() => {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endsection