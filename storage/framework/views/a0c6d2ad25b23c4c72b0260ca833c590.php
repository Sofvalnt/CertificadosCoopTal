<?php $__env->startSection('title', 'Principal'); ?>

<?php $__env->startSection('content_header'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Cooperativa Talanga Ltda.</title>
    <style>
        /* Estilos generales */
        :root {
            --primary: #2c5e1a;
            --secondary: #f8c537;
            --light: #f5f7fa;
            --dark: #1e293b;
            --hover-yellow: #f9ff32;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Sección de bienvenida */
        .welcome-container {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
            background: linear-gradient(135deg, var(--primary) 0%, #4a8c2a 100%);
            color: white;
            overflow: hidden;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
        }

        .saludo {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.3);
        }

        .saludo:hover {
            color: var(--hover-yellow);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--secondary);
            color: var(--primary);
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn:hover {
            background-color: var(--hover-yellow);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .logo {
            width: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(2px 2px 4px rgba(247, 242, 242, 0.3));
        }

        /* Elementos flotantes */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        .floating-element:hover {
            background-color: var(--hover-yellow);
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
            }
        }

        /* Estadísticas */
        .stats-container {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-top: 50px;
        }

        .stat-item {
            background-color: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 10px;
            width: 22%;
            backdrop-filter: blur(5px);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: scale(1.05);
            background-color: rgba(249, 255, 50, 0.2);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--secondary);
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Efecto de escritura */
        .typing-effect {
            border-right: 3px solid var(--secondary);
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--secondary) }
        }

        /* Dashboard de diplomas */
        .dashboard {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            text-align: center;
        }

        .buscador {
            width: 100%;
            padding: 12px;
            margin-bottom: 30px;
            border: 2px solid #ddd;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s;
        }

        .buscador:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        /* Galería de diplomas */
        .contenedor-diplomas {
            display: flex;
            flex-direction: column;
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
        }

        .diploma-item {
            display: flex;
            align-items: center;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        /* Contenedor de imagen con efecto 3D */
        .imagen-container {
            width: 300px;
            height: 200px;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            transform-style: preserve-3d;
            transition: transform 0.1s;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .imagen-container:nth-child(1) { animation-delay: 0.1s; }
        .imagen-container:nth-child(2) { animation-delay: 0.2s; }
        .imagen-container:nth-child(3) { animation-delay: 0.3s; }
        .imagen-container:nth-child(4) { animation-delay: 0.4s; }
        .imagen-container:nth-child(5) { animation-delay: 0.5s; }

        .imagen-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .imagen-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            padding: 12px;
            color: white;
            transform: translateY(100%);
            transition: transform 0.3s;
        }

        .imagen-container:hover .imagen-info {
            transform: translateY(0);
        }

        .imagen-titulo {
            font-size: 16px;
            text-align: center;
            margin: 0;
        }

        /* Botón de generación */
        .boton-link {
            display: inline-block;
            padding: 12px 25px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .boton-link:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Lightbox */
        .modal-lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            cursor: zoom-out;
        }

        .imagen-ampliada {
            max-height: 90vh;
            max-width: 90vw;
            border-radius: 8px;
            box-shadow: 0 0 30px rgba(255,255,255,0.3);
        }

        .cerrar-lightbox {
            position: absolute;
            top: 30px;
            right: 30px;
            color: white;
            font-size: 40px;
            cursor: pointer;
            z-index: 10001;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .saludo {
                font-size: 2.5rem;
            }
            
            .stats-container {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            
            .stat-item {
                width: 80%;
            }
            
            .diploma-item {
                flex-direction: column;
            }
            
            .imagen-container {
                width: 100%;
            }
            
            .boton-link {
                width: 100%;
                text-align: center;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-container">
    <div class="floating-elements">
        <!-- Elementos flotantes generados dinámicamente -->
    </div>
    
    <div class="welcome-content">
        <img src="<?php echo e(asset('vendor/adminlte/dist/img/AdminLTELogo.png')); ?>" alt="Logo Cooperativa Talanga" class="logo">
        <h1 class="saludo">Bienvenido a Cooperativa de Ahorro y Credito <span class="typing-effect">"Talanga" Limitada</span></h1>
        <p>Tu aliado financiero para un futuro más próspero. Juntos crecemos, juntos prosperamos.</p>
        <a href="<?php echo e(url('generador')); ?>" class="btn">Acceder al Generador</a>
        
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-value" id="members-count">+7,000</div>
                <div class="stat-label">Afiliados Activos</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-value" id="years-active">56 años</div>
                <div class="stat-label">Años de Servicio</div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard">
    <h2><i class="fas fa-certificate"></i> Diplomas Disponibles</h2>
    
    <input type="text" id="buscador-diplomas" placeholder="Buscar diploma..." class="buscador">
    
    <div class="contenedor-diplomas">
        <!-- Diploma 1 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="<?php echo e(asset('vendor/adminlte/dist/img/diploma.png')); ?>">
                <img src="<?php echo e(asset('vendor/adminlte/dist/img/diploma.png')); ?>" 
                     alt="Diploma Básico" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Diploma Básico</div>
                </div>
            </div>
            <a href="<?php echo e(url('generador')); ?>" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma 1
            </a>
        </div>
        
           <!-- Diploma 5 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="<?php echo e(asset('vendor/adminlte/dist/img/general2.png')); ?>">
                <img src="<?php echo e(asset('vendor/adminlte/dist/img/general2.png')); ?>" 
                     alt="Diploma General" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Diploma General</div>
                </div>
            </div>
            <a href="<?php echo e(url('general')); ?>" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma General 2
            </a>
        </div> 

        <!-- Diploma 2 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="<?php echo e(asset('vendor/adminlte/dist/img/juventud.png')); ?>">
                <img src="<?php echo e(asset('vendor/adminlte/dist/img/juventud.png')); ?>" 
                     alt="Diploma Juventud" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Juventud</div>
                </div>
            </div>
            <a href="<?php echo e(url('juventud')); ?>" class="boton-link">
                <i class="fas fa-download"></i> Generar diploma para Comite de Juventud
            </a>
        </div>
        
        <!-- Diploma 3 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="<?php echo e(asset('vendor/adminlte/dist/img/genero.png')); ?>">
                <img src="<?php echo e(asset('vendor/adminlte/dist/img/genero.png')); ?>" 
                     alt="Diploma Género" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Género</div>
                </div>
            </div>
            <a href="<?php echo e(url('genero')); ?>" class="boton-link">
                <i class="fas fa-download"></i> Generar diploma para Comite de Genero
            </a>
        </div>
        
        <!-- Diploma 4 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="<?php echo e(asset('vendor/adminlte/dist/img/educacion.png')); ?>">
                <img src="<?php echo e(asset('vendor/adminlte/dist/img/educacion.png')); ?>" 
                     alt="Diploma Educación" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Educación</div>
                </div>
            </div>
            <a href="<?php echo e(url('educacion')); ?>" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma para Comite de Educacion
            </a>
        </div>
        
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    // Generar elementos flotantes
    const floatingContainer = document.querySelector('.floating-elements');
    for (let i = 0; i < 30; i++) {
        const element = document.createElement('div');
        element.classList.add('floating-element');
        
        const size = Math.random() * 100 + 20;
        const posX = Math.random() * 100;
        const delay = Math.random() * 8;
        const duration = Math.random() * 5 + 5;
        
        element.style.width = `${size}px`;
        element.style.height = `${size}px`;
        element.style.left = `${posX}%`;
        element.style.bottom = `-${size}px`;
        element.style.animationDelay = `${delay}s`;
        element.style.animationDuration = `${duration}s`;
        
        floatingContainer.appendChild(element);
    }

    // Animación de contadores
    function animateValue(id, start, end, duration, prefix = '+', suffix = '') {
        const obj = document.getElementById(id);
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            
            if (id.includes('amount')) {
                obj.innerHTML = prefix + value.toLocaleString() + suffix;
            } else {
                obj.innerHTML = prefix + value + suffix;
            }
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Iniciar animaciones de contadores
    animateValue('members-count', 0, 7000, 2000, '+', '');
    animateValue('years-active', 0, 56, 2000, '', ' años');

    // Efecto Tilt 3D para diplomas
    document.querySelectorAll('.imagen-container').forEach(container => {
        container.addEventListener('mousemove', (e) => {
            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = container.offsetWidth / 2;
            const centerY = container.offsetHeight / 2;
            
            const angleX = (y - centerY) / 15;
            const angleY = (centerX - x) / 15;
            
            container.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
            container.querySelector('.imagen-preview').style.transform = 'scale(1.05)';
        });

        container.addEventListener('mouseleave', () => {
            container.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            container.querySelector('.imagen-preview').style.transform = 'scale(1)';
        });
    });

    // Filtro de búsqueda
    document.getElementById('buscador-diplomas').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.diploma-item').forEach(item => {
            const title = item.querySelector('.imagen-titulo').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Lightbox
    document.querySelectorAll('.imagen-container').forEach(container => {
        container.addEventListener('click', (e) => {
            const imgSrc = container.getAttribute('data-img');
            const modal = document.createElement('div');
            modal.className = 'modal-lightbox';
            
            modal.innerHTML = `
                <img src="${imgSrc}" class="imagen-ampliada">
                <span class="cerrar-lightbox">&times;</span>
            `;
            
            document.body.appendChild(modal);
            
            // Cerrar lightbox
            modal.querySelector('.cerrar-lightbox').addEventListener('click', () => {
                modal.remove();
            });
            
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.remove();
            });
        });
    });

    
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .sidebar {
            font-size: 14px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/dashboard.blade.php ENDPATH**/ ?>