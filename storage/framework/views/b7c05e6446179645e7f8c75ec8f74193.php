<?php $__env->startSection('title', 'Perfil de Usuario'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="profile-header">
        <h1 class="text-center"><i class="fas fa-user-circle mr-2"></i>Perfil del Usuario</h1>
        <p class="text-center text-muted">Administra toda tu información personal y configuración de seguridad</p>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="nav-item logout-form">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
                    </button>
                </form>
            </div>

            <!-- Tarjeta de Información del Perfil -->
            <div class="profile-card">
                <!-- Sección de Información Personal -->
                <div class="profile-section active-section" id="personal-info">
                    <?php if(Laravel\Fortify\Features::canUpdateProfileInformation()): ?>
                    <div class="section-content">
                        <h2><i class="fas fa-user-edit mr-2"></i>Información Personal</h2>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-profile-information-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sección de Seguridad -->
                <div class="profile-section" id="security">
                    <?php if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords())): ?>
                    <div class="security-item">
                        <h3><i class="fas fa-key mr-2"></i>Cambiar Contraseña</h3>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-password-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>
                    <?php endif; ?>

                    <?php if(Laravel\Fortify\Features::canManageTwoFactorAuthentication()): ?>
                    <div class="security-item">
                        <h3><i class="fas fa-mobile-alt mr-2"></i>Autenticación de Dos Factores</h3>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.two-factor-authentication-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sección de Sesiones -->
                <div class="profile-section" id="sessions">
                    <div class="security-item">
                        <h3><i class="fas fa-laptop mr-2"></i>Sesiones Activas</h3>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.logout-other-browser-sessions-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>

                    <?php if(Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures()): ?>
                    <div class="danger-section">
                        <h3><i class="fas fa-exclamation-triangle mr-2"></i>Eliminar Cuenta</h3>
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.delete-user-form');

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-4', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/profile/show.blade.php ENDPATH**/ ?>