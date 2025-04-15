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
            <!-- Sidebar horizontal funcional -->
            <div class="horizontal-sidebar bg-white rounded-lg shadow-md p-4 mb-6 overflow-x-auto">
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
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>

            <!-- Contenido principal -->
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

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-2', $__slots ?? [], get_defined_vars());

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

$__html = app('livewire')->mount($__name, $__params, 'lw-203675925-3', $__slots ?? [], get_defined_vars());

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
        background: linear-gradient(135deg, #05846b 25%, rgb(243, 232, 71) 100%);
        color: white;
        margin-bottom: 30px;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    /* Sidebar horizontal */
    .horizontal-sidebar {
        transition: all 0.3s ease;
    }
    
    .horizontal-sidebar::-webkit-scrollbar {
        height: 5px;
    }
    
    .horizontal-sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }
    
    /* Botones del sidebar */
    .sidebar-btn {
        padding: 10px 16px;
        border-radius: 8px;
        background-color: #f8fafc;
        color: #334155;
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
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-btn.active {
        background: #05846b;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-btn.logout-btn {
        background-color: #fee2e2;
        color: #b91c1c;
    }
    
    .sidebar-btn.logout-btn:hover {
        background-color: #fecaca;
        color: #991b1b;
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
    
    /* Items de contenido */
    .security-item {
        margin-bottom: 30px;
        padding: 25px;
        background: #f7fafc;
        border-radius: 8px;
        border-left: 4px solid #4299e1;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .danger-section {
        background-color: #fff5f5;
        border-left: 4px solid #e53e3e;
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
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
            confirmButtonColor: '#05846b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/profile/show.blade.php ENDPATH**/ ?>