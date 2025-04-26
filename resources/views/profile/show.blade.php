@extends('adminlte::page')

@section('title', 'Perfil de Usuario')

@section('content_header')
    <div class="profile-header">
        <div class="header-content">
            <div class="avatar-container">
                <div class="avatar-circle">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
            <h1>Perfil del Usuario</h1>
            <p class="header-subtitle">Administra tu información personal y configuración de seguridad</p>
        </div>
    </div>
@stop

@section('content')
<x-app-layout>
    <div class="profile-container">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Botón de modo oscuro flotante -->
            <button id="botonModoOscuro" onclick="alternarModoOscuro()" class="theme-toggle-btn">
                <span class="theme-icon" id="iconoTema"></span>
            </button>

            <!-- Tarjeta principal con pestañas -->
            <div class="profile-main-card">
                <!-- Barra de pestañas -->
                <div class="profile-tabs">
                    <button class="profile-tab active" data-section="personal-info">
                        <i class="fas fa-user"></i>
                        <span>Información</span>
                    </button>
                    <button class="profile-tab" data-section="security">
                        <i class="fas fa-shield-alt"></i>
                        <span>Seguridad</span>
                    </button>
                    <button class="profile-tab" data-section="sessions">
                        <i class="fas fa-laptop"></i>
                        <span>Sesiones</span>
                    </button>
                    <div class="tab-underline"></div>
                </div>

                <!-- Contenido de las pestañas -->
                <div class="profile-content">
                    <!-- Sección de Información Personal -->
                    <div class="profile-section active-section" id="personal-info">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-user-edit"></i>
                                <h2>Información Personal</h2>
                            </div>
                            @livewire('profile.update-profile-information-form')
                        </div>
                        @endif
                    </div>

                    <!-- Sección de Seguridad -->
                    <div class="profile-section" id="security">
                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="section-card security-card">
                            <div class="section-header">
                                <i class="fas fa-key"></i>
                                <h2>Cambiar Contraseña</h2>
                            </div>
                            @livewire('profile.update-password-form')
                        </div>
                        @endif
                    </div>

                    <!-- Sección de Sesiones -->
                    <div class="profile-section" id="sessions">
                        <div class="section-card security-card">
                            <div class="section-header">
                                <i class="fas fa-laptop"></i>
                                <h2>Sesiones Activas</h2>
                            </div>
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <div class="section-card danger-card">
                            <div class="section-header">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h2>Eliminar Cuenta</h2>
                            </div>
                            @livewire('profile.delete-user-form')
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Botón de cerrar sesión flotante -->
                <button class="logout-btn" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

@section('css')
<style>
    :root {
        /* Paleta de colores principal */
        --primary: #2c5e1a;       /* Verde principal */
        --primary-100: #e8f3e4;  /* Verde muy claro */
        --primary-200: #c2e0b9;
        --primary-300: #9bcc8e;
        --primary-400: #75b963;
        --primary-500: #4a8c2a;   /* Verde medio */
        --primary-600: #3a7a22;
        --primary-700: #2c5e1a;   /* Verde principal */
        --primary-800: #1e4612;
        --primary-900: #0f2e09;   /* Verde muy oscuro */
        
        --secondary: #f8c537;     /* Amarillo principal */
        --secondary-100: #fef8e6;
        --secondary-200: #fcecbd;
        --secondary-300: #fadf94;
        --secondary-400: #f9d36b;
        --secondary-500: #f8c537; /* Amarillo principal */
        --secondary-600: #e6b22e;
        --secondary-700: #d4a026;
        --secondary-800: #c28e1e;
        --secondary-900: #b07c16;
        
        /* Escala de grises */
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        
        /* Colores funcionales */
        --success: #38a169;
        --warning: #dd6b20;
        --danger: #e53e3e;
        --info: #3182ce;
        
        /* Variables de tema claro */
        --bg-color: #ffffff;
        --text-color: var(--gray-800);
        --card-bg: #ffffff;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --header-bg: linear-gradient(135deg, var(--primary-700) 0%, var(--primary-500) 100%);
        --header-text: white;
        --border-color: var(--gray-200);
        --hover-bg: var(--primary-100);
    }

    .dark-mode {
        /* Variables de tema oscuro */
        --bg-color: #121212;
        --text-color: #e0e0e0;
        --card-bg: #1e1e1e;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        --header-bg: linear-gradient(135deg, var(--primary-900) 0%, var(--primary-700) 100%);
        --header-text: white;
        --border-color: #333333;
        --hover-bg: var(--primary-900);
    }

    /* Estilos base */
    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        transition: all 0.3s ease;
    }

    /* Encabezado del perfil */
    .profile-header {
        background: var(--header-bg);
        color: var(--header-text);
        padding: 2rem 0 4rem;
        margin-bottom: -2rem;
        position: relative;
        overflow: hidden;
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        padding: 0 1rem;
    }

    .avatar-container {
        margin-bottom: 1rem;
    }

    .avatar-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-header h1 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Tarjeta principal */
    .profile-main-card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        position: relative;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }

    /* Pestañas */
    .profile-tabs {
        display: flex;
        position: relative;
        border-bottom: 1px solid var(--border-color);
        padding: 0 1.5rem;
    }

    .profile-tab {
        padding: 1.2rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--text-color);
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .profile-tab i {
        font-size: 1.1rem;
    }

    .profile-tab.active {
        opacity: 1;
        color: var(--primary-700);
    }

    .dark-mode .profile-tab.active {
        color: var(--secondary-500);
    }

    .profile-tab:hover {
        opacity: 1;
        color: var(--primary-700);
    }

    .dark-mode .profile-tab:hover {
        color: var(--secondary-500);
    }

    .tab-underline {
        position: absolute;
        bottom: -1px;
        left: 0;
        height: 2px;
        background: var(--primary-500);
        transition: all 0.3s ease;
    }

    .dark-mode .tab-underline {
        background: var(--secondary-500);
    }

    /* Contenido de las secciones */
    .profile-content {
        padding: 2rem 1.5rem;
    }

    .profile-section {
        display: none;
        animation: fadeIn 0.4s ease;
    }

    .profile-section.active-section {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Tarjetas de sección */
    .section-card {
        background: var(--card-bg);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .section-header i {
        font-size: 1.5rem;
        color: var(--primary-500);
    }

    .dark-mode .section-header i {
        color: var(--secondary-500);
    }

    .section-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-700);
        margin: 0;
    }

    .dark-mode .section-header h2 {
        color: var(--secondary-500);
    }

    /* Tarjetas especiales */
    .security-card {
        border-left: 4px solid var(--primary-500);
    }

    .dark-mode .security-card {
        border-left-color: var(--secondary-500);
    }

    .danger-card {
        border-left: 4px solid var(--danger);
        background-color: rgba(229, 62, 62, 0.05);
    }

    .dark-mode .danger-card {
        background-color: rgba(229, 62, 62, 0.1);
    }

    /* Botones especiales */
    .theme-toggle-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 100;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .theme-toggle-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .theme-icon {
        display: inline-block;
        width: 24px;
        height: 24px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        transition: all 0.3s ease;
    }

    .theme-icon {
        background-image: url("{{ asset('vendor/adminlte/dist/img/day.png') }}");
    }

    .dark-mode .theme-icon {
        background-image: url("{{ asset('vendor/adminlte/dist/img/night.png') }}");
    }

    .logout-btn {
        position: absolute;
        bottom: -20px;
        right: 20px;
        padding: 0.75rem 1.5rem;
        background-color: var(--danger);
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .logout-btn:hover {
        background-color: #c53030;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(229, 62, 62, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-header {
            padding: 1.5rem 0 3rem;
        }
        
        .avatar-circle {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .profile-header h1 {
            font-size: 1.5rem;
        }
        
        .profile-tabs {
            overflow-x: auto;
            padding: 0;
        }
        
        .profile-tab {
            padding: 1rem;
            font-size: 0.85rem;
        }
        
        .profile-content {
            padding: 1.5rem 1rem;
        }
        
        .theme-toggle-btn {
            top: 15px;
            right: 15px;
            width: 38px;
            height: 38px;
        }
        
        .logout-btn {
            position: relative;
            bottom: auto;
            right: auto;
            margin: 1.5rem auto 0;
            display: inline-flex;
        }
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación de las pestañas
        const tabs = document.querySelectorAll('.profile-tab');
        const underline = document.querySelector('.tab-underline');
        const sections = document.querySelectorAll('.profile-section');
        
        // Inicializar subrayado
        const activeTab = document.querySelector('.profile-tab.active');
        if(activeTab) {
            underline.style.width = `${activeTab.offsetWidth}px`;
            underline.style.left = `${activeTab.offsetLeft}px`;
        }
        
        // Controlador de clicks para las pestañas
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section');
                
                // Remover clase active de todas las pestañas
                tabs.forEach(t => t.classList.remove('active'));
                
                // Añadir clase active a la pestaña clickeada
                this.classList.add('active');
                
                // Mover el subrayado
                underline.style.width = `${this.offsetWidth}px`;
                underline.style.left = `${this.offsetLeft}px`;
                
                // Ocultar todas las secciones
                sections.forEach(section => {
                    section.classList.remove('active-section');
                });
                
                // Mostrar la sección correspondiente
                const targetSection = document.getElementById(sectionId);
                if(targetSection) {
                    targetSection.classList.add('active-section');
                }
            });
        });
        
        // Efecto de carga inicial
        setTimeout(() => {
            document.body.style.opacity = '1';
        }, 50);
    });

    // Función de confirmación para cerrar sesión
    function confirmLogout() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "¿Estás seguro de que deseas salir de tu cuenta?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--danger)',
            cancelButtonColor: 'var(--gray-500)',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar',
            background: 'var(--card-bg)',
            color: 'var(--text-color)'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    // Modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        // Agregar efecto de transición
        document.body.style.transition = 'all 0.3s ease';
    }

    // Verificar modo oscuro al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
        }
        
        // Agregar transición después de la carga
        setTimeout(() => {
            document.body.style.transition = 'all 0.3s ease';
        }, 100);
    });
</script>
@endsection