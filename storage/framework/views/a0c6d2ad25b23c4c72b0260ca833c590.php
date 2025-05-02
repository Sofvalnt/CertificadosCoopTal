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
            --bg-color: #ffffff;
            --text-color: #333333;
            --panel-bg: #f8f9fa;
            --card-bg: #ffffff;
            --bubble-color: rgba(44, 94, 26, 0.2);
            --bubble-size: 1;
            --bubble-speed: 15s;
            --bubble-blur: 0px;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --panel-bg: #2d2d2d;
            --light: #2d3748;
            --dark: #f5f7fa;
            --card-bg: #2d3748;
            --bubble-color: rgba(248, 197, 55, 0.4);
            --bubble-size: 1.5;
            --bubble-speed: 8s;
            --bubble-blur: 2px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.5s, color 0.5s;
            margin: 0;
            padding: 0;
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

        /* Elementos flotantes - Burbujas */
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
            background-color: var(--bubble-color);
            border-radius: 50%;
            animation: float var(--bubble-speed) infinite linear;
            transition: all 0.3s ease-out;
            filter: blur(var(--bubble-blur));
            transform: scale(var(--bubble-size));
            box-shadow: 0 0 10px currentColor;
            cursor: pointer;
            user-select: none;
        }

        .floating-element:hover {
            animation-play-state: paused;
        }

        .floating-element.exploding {
            animation: none;
            transform: scale(2);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Partículas de explosión */
        .particle {
            position: absolute;
            background-color: #ffeb3b;
            border-radius: 50%;
            pointer-events: none;
            z-index: 20;
            box-shadow: 0 0 10px #fff;
            transform: translate(0, 0) scale(1);
        }

        /* Onda expansiva */
        .shockwave {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,235,59,0.8) 0%, rgba(255,235,59,0) 70%);
            z-index: 10;
            transform: scale(0);
            animation: shockwave 1s ease-out forwards;
            pointer-events: none;
        }

        /* Animaciones */
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg) scale(var(--bubble-size));
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg) scale(var(--bubble-size));
                opacity: 0;
            }
        }

        @keyframes particle-explosion {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(0.1);
                opacity: 0;
            }
        }

        @keyframes shockwave {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(3);
                opacity: 0;
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
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Botón de modo oscuro -->
<button id="botonModoOscuro" onclick="alternarModoOscuro()" style="position: fixed; top: 20px; right: 20px; z-index: 1000; background: transparent; border: none;">
    <img src="<?php echo e(asset('vendor/adminlte/dist/img/day.png')); ?>" alt="Modo Claro" id="iconoTema" width="40" height="40" style="transition: transform 0.5s;">
</button>

<div class="welcome-container">
    <div class="floating-elements" id="bubbles-container">
        <!-- Burbujas generadas dinámicamente -->
    </div>
    
    <div class="welcome-content">
        <img src="<?php echo e(asset('vendor/adminlte/dist/img/AdminLTELogo.png')); ?>" alt="Logo Cooperativa Talanga" class="logo">
        <h1 class="saludo">Bienvenido a Cooperativa de Ahorro y Credito <span class="typing-effect">"Talanga" Limitada</span></h1>
        <p>Tu aliado financiero para un futuro más próspero. Juntos crecemos, juntos prosperamos.</p>
        <a href="<?php echo e(asset('vendor/adminlte/dist/img/ManualdeUsuario.pdf')); ?>" class="btn" download>MANUAL DE USO</a>
        <a href="<?php echo e(url('generacion')); ?>" class="btn">DIPLOMAS</a>
        <a href="<?php echo e(url('generacionCertificados')); ?>" class="btn">CERTIFICADOS</a>
        
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

<!-- Resto del contenido... -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    // Variables globales
    let bubbles = [];

    // Generar burbujas
    function generarBurbujas() {
        const bubblesContainer = document.getElementById('bubbles-container');
        bubblesContainer.innerHTML = '';
        bubbles = [];
        
        const bubbleCount = 25;
        const colors = document.body.classList.contains('dark-mode') 
            ? ['rgba(248, 197, 55, 0.6)', 'rgba(249, 255, 50, 0.5)', 'rgba(255, 215, 0, 0.5)']
            : ['rgba(44, 94, 26, 0.3)', 'rgba(76, 154, 42, 0.3)', 'rgba(106, 176, 76, 0.3)'];
        
        for (let i = 0; i < bubbleCount; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('floating-element');
            
            const size = Math.random() * 80 + 40;
            const posX = Math.random() * 100;
            const delay = Math.random() * 5;
            const duration = (Math.random() * 10 + 5) * (document.body.classList.contains('dark-mode') ? 0.7 : 1);
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${posX}%`;
            bubble.style.bottom = `-${size}px`;
            bubble.style.animationDelay = `${delay}s`;
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.backgroundColor = color;
            bubble.dataset.color = color;
            
            if (document.body.classList.contains('dark-mode')) {
                bubble.style.boxShadow = `0 0 20px ${color}`;
                bubble.style.filter = 'blur(1px)';
            }
            
            bubble.addEventListener('click', function() {
                explotarBurbuja(bubble);
            });
            
            bubblesContainer.appendChild(bubble);
            bubbles.push(bubble);
        }
    }

    // Función para explotar burbujas
    function explotarBurbuja(bubble) {
        const rect = bubble.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        
        // Crear onda expansiva
        const shockwave = document.createElement('div');
        shockwave.classList.add('shockwave');
        shockwave.style.width = `${size}px`;
        shockwave.style.height = `${size}px`;
        shockwave.style.left = `${rect.left}px`;
        shockwave.style.top = `${rect.top}px`;
        document.body.appendChild(shockwave);
        
        // Animación de explosión
        bubble.classList.add('exploding');
        
        // Crear partículas
        crearParticulas(centerX, centerY, size, bubble.dataset.color);
        
        // Eliminar elementos después de la animación
        setTimeout(() => {
            bubble.remove();
            shockwave.remove();
        }, 500);
    }

    // Crear partículas de explosión
    function crearParticulas(x, y, size, color) {
        const container = document.getElementById('bubbles-container');
        const particleCount = Math.min(20, Math.floor(size / 4));
        const baseColor = color || '#ffeb3b';
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            const particleSize = Math.random() * 10 + 5;
            const angle = Math.random() * Math.PI * 2;
            const distance = Math.random() * size * 0.8 + 30;
            const duration = Math.random() * 0.6 + 0.4;
            
            particle.style.width = `${particleSize}px`;
            particle.style.height = `${particleSize}px`;
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;
            particle.style.backgroundColor = baseColor;
            
            // Variación de color para algunas partículas
            if (Math.random() > 0.7) {
                particle.style.backgroundColor = '#ff9800'; // Naranja
            }
            
            // Animación
            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;
            particle.style.setProperty('--tx', `${tx}px`);
            particle.style.setProperty('--ty', `${ty}px`);
            particle.style.animation = `particle-explosion ${duration}s forwards`;
            
            container.appendChild(particle);
            
            // Eliminar partícula después de la animación
            setTimeout(() => {
                particle.remove();
            }, duration * 1000);
        }
    }

    // Modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "<?php echo e(asset('vendor/adminlte/dist/img/night.png')); ?>";
            icono.style.transform = 'rotate(360deg)';
        } else {
            icono.src = "<?php echo e(asset('vendor/adminlte/dist/img/day.png')); ?>";
            icono.style.transform = 'rotate(0deg)';
        }
        
        generarBurbujas();
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

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "<?php echo e(asset('vendor/adminlte/dist/img/night.png')); ?>";
        }
        
        generarBurbujas();
        animateValue('members-count', 0, 7000, 2000, '+', '');
        animateValue('years-active', 0, 56, 2000, '', ' años');
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/dashboard.blade.php ENDPATH**/ ?>