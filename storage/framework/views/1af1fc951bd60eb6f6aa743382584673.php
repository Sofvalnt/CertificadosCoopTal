<?php $__env->startSection('auth_header', __('Cambio de Contraseña Obligatorio')); ?>

<?php $__env->startSection('auth_body'); ?>
    <div class="alert alert-warning">
        <i class="icon fas fa-exclamation-triangle"></i>
        Por seguridad, debe cambiar su contraseña temporal para continuar
    </div>

    <form method="POST" action="<?php echo e(route('first-login')); ?>" id="passwordForm">
        <?php echo csrf_field(); ?>
        
        <!-- Contraseña Temporal -->
        <div class="input-group mb-3">
            <input type="password" name="current_password" 
                   class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Contraseña Temporal" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Nueva Contraseña -->
        <div class="input-group mb-3">
            <input type="password" name="new_password"
                   class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Nueva Contraseña" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Confirmar Contraseña -->
        <div class="input-group mb-3">
            <input type="password" name="new_password_confirmation"
                   class="form-control"
                   placeholder="Confirmar Nueva Contraseña" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save mr-2"></i>
                    Guardar Nueva Contraseña
                </button>
            </div>
            <div class="col-md-6 mt-2 mt-md-0">
                <a href="#" class="btn btn-danger btn-block" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </form>

    <!-- Formulario oculto para logout -->
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <script>
    // Variable para controlar el envío del formulario
    let formSubmitted = false;

    // Previene que el usuario salga sin cambiar la contraseña
    window.addEventListener('beforeunload', function(e) {
        <?php if(auth()->check() && auth()->user()->is_first_login): ?>
        if (!formSubmitted) {
            e.preventDefault();
            e.returnValue = '¿Estás seguro de querer salir sin cambiar tu contraseña temporal?';
            return e.returnValue;
        }
        <?php endif; ?>
    });

    // Marca el formulario como enviado cuando se haga submit
    document.getElementById('passwordForm').addEventListener('submit', function() {
        formSubmitted = true;
    });

    <form method="POST" action="<?php echo e(route('password.update')); ?>">
    <?php echo csrf_field(); ?>
    <!-- Campos de contraseña temporal, nueva y confirmación -->
    <button type="submit">Guardar</button>
</form>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::auth.auth-page', ['auth_type' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/auth/first-login.blade.php ENDPATH**/ ?>