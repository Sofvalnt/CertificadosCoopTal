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
            <!-- Botón de modo oscuro -->
            <button id="botonModoOscuro" onclick="alternarModoOscuro()" class="fixed top-5 right-5 z-50">
                <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema" class="w-10 h-10 transition-transform duration-300">
            </button>

            <!-- Sidebar horizontal funcional -->
            <div class="horizontal-sidebar bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-6 overflow-x-auto">
                <div class="flex flex-nowrap md:flex-wrap gap-2">
                    <button class="sidebar-btn active" data-section="personal-info">
                        <i class="fas fa-user mr-2"></i>Información Personal
                    </button>
                    <button class="sidebar-btn" data-section="security">
                        <i class="fas fa-shield-alt mr-2"></i>Seguridad
                    </button>
                    <button class="sidebar-btn" data-section="sessions">
                        <i class="fas fa-laptop mr-2"></i>Sesiones
                    </button>
                    <button type="button" class="sidebar-btn logout-btn ml-auto" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="profile-card bg-white dark:bg-gray-800">
                <!-- Sección de Información Personal -->
                <div class="profile-section active-section" id="personal-info">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="section-content">
                        <h2 class="text-gray-800 dark:text-gray-200"><i class="fas fa-user-edit mr-2"></i>Información Personal</h2>
                        @livewire('profile.update-profile-information-form')
                    </div>
                    @endif
                </div>

                <!-- Sección de Seguridad -->
                <div class="profile-section" id="security">
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="security-item bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-gray-800 dark:text-gray-200"><i class="fas fa-key mr-2"></i>Cambiar Contraseña</h3>
                        @livewire('profile.update-password-form')
                    </div>
                    @endif
                </div>

                <!-- Sección de Sesiones -->
                <div class="profile-section" id="sessions">
                    <div class="security-item bg-gray-50 dark:bg-gray-700">
                        <h3 class="text-gray-800 dark:text-gray-200"><i class="fas fa-laptop mr-2"></i>Sesiones Activas</h3>
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="danger-section bg-red-50 dark:bg-red-900 dark:bg-opacity-20">
                        <h3 class="text-gray-800 dark:text-gray-200"><i class="fas fa-exclamation-triangle mr-2"></i>Eliminar Cuenta</h3>
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
    :root {
        --primary: #2c5e1a;
        --secondary: #f8c537;
        --light: #f5f7fa;
        --dark: #1e293b;
        --hover-yellow: #f9ff32;
        --bg-color: #ffffff;
        --text-color: #333333;
        --panel-bg: #f8f9fa;
        --card-bg: #ffffff;
        --header-bg: linear-gradient(135deg, #2c5e1a 0%, #4a8c2a 100%);
        --header-text: white;
        --sidebar-bg: #ffffff;
        --sidebar-text: #334155;
        --sidebar-active: #2c5e1a;
        --sidebar-hover: #e2e8f0;
        --danger-bg: #fff5f5;
        --danger-border: #e53e3e;
        --logout-bg: #fee2e2;
        --logout-text: #b91c1c;
        --logout-hover: #fecaca;
    }

    .dark-mode {
        --primary: #2c5e1a;
        --secondary: #f8c537;
        --light: #2d3748;
        --dark: #f5f7fa;
        --hover-yellow: #f9ff32;
        --bg-color: #1a1a1a;
        --text-color: #e0e0e0;
        --panel-bg: #2d2d2d;
        --card-bg: #2d3748;
        --header-bg: linear-gradient(135deg, #2c5e1a 0%, #2c5e1a 100%);
        --header-text: white;
        --sidebar-bg: #2d3748;
        --sidebar-text: #e2e8f0;
        --sidebar-active: #f8c537;
        --sidebar-hover: #4a5568;
        --danger-bg: #4a1c1c;
        --danger-border: #e53e3e;
        --logout-bg: #4a1c1c;
        --logout-text: #fecaca;
        --logout-hover: #991b1b;
    }

    /* Estilos generales */
    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        transition: background-color 0.5s, color 0.5s;
    }

    .profile-container {
        background-color: var(--bg-color);
        min-height: calc(100vh - 60px);
    }
    
    .profile-header {
        padding: 20px 0;
        background: var(--header-bg);
        color: var(--header-text);
        margin-bottom: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Sidebar horizontal */
    .horizontal-sidebar {
        transition: all 0.3s ease;
        background-color: var(--sidebar-bg);
    }
    
    .horizontal-sidebar::-webkit-scrollbar {
        height: 5px;
    }
    
    .horizontal-sidebar::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 10px;
    }
    
    /* Botones del sidebar */
    .sidebar-btn {
        padding: 10px 16px;
        border-radius: 8px;
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        white-space: nowrap;
        margin-right: 8px;
        flex-shrink: 0;
    }
    
    .sidebar-btn:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text);
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-btn.active {
        background: var(--sidebar-active);
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-btn.logout-btn {
        background-color: var(--logout-bg);
        color: var(--logout-text);
    }
    
    .sidebar-btn.logout-btn:hover {
        background-color: var(--logout-hover);
        color: var(--logout-text);
    }
    
    /* Tarjeta de perfil */
    .profile-card {
        background: var(--card-bg);
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
    
    /* Items de contenido */
    .security-item {
        margin-bottom: 30px;
        padding: 25px;
        background: var(--panel-bg);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .danger-section {
        background-color: var(--danger-bg);
        border-left: 4px solid var(--danger-border);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .profile-header h1 {
            font-size: 2rem;
        }
        
        .sidebar-btn {
            padding: 8px 12px;
            font-size: 0.9rem;
        }
        
        .profile-card {
            padding: 20px;
        }
        
        .security-item {
            padding: 15px;
        }

        #botonModoOscuro {
            top: 15px;
            right: 15px;
        }
    }
</style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Controlador de clicks para los botones del sidebar
        document.querySelectorAll('.sidebar-btn:not(.logout-btn)').forEach(btn => {
            btn.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section');
                
                // Remover clase active de todos los botones
                document.querySelectorAll('.sidebar-btn').forEach(b => {
                    b.classList.remove('active');
                });
                
                // Añadir clase active al botón clickeado
                this.classList.add('active');
                
                // Ocultar todas las secciones
                document.querySelectorAll('.profile-section').forEach(section => {
                    section.classList.remove('active-section');
                });
                
                // Mostrar la sección correspondiente
                const targetSection = document.getElementById(sectionId);
                if(targetSection) {
                    targetSection.classList.add('active-section');
                    
                    // Scroll suave a la sección
                    window.scrollTo({
                        top: targetSection.offsetTop - 20,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Activar la primera sección por defecto
        if(!document.querySelector('.profile-section.active-section')) {
            const firstSection = document.querySelector('.profile-section');
            if(firstSection) firstSection.classList.add('active-section');
        }
        
        // Activar el primer botón por defecto
        if(!document.querySelector('.sidebar-btn.active')) {
            const firstBtn = document.querySelector('.sidebar-btn:not(.logout-btn)');
            if(firstBtn) firstBtn.classList.add('active');
        }
    });

    // Función de confirmación para cerrar sesión
    function confirmLogout() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "¿Estás seguro de que deseas salir de tu cuenta?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2c5e1a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
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
        
        // Cambiar ícono según el modo
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            icono.style.transform = 'rotate(360deg)';
        } else {
            icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
            icono.style.transform = 'rotate(0deg)';
        }
    }

    // Verificar modo oscuro al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
        }
    });
</script>
@endsection