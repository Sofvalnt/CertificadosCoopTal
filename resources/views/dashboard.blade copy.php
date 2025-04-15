@extends('adminlte::page')

@section('title', 'Principal')

@section('content_header')
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
            --bubble-color: rgba(255, 255, 255, 0.1);
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --panel-bg: #2d2d2d;
            --light: #2d3748;
            --dark: #f5f7fa;
            --card-bg: #2d3748;
            --bubble-color: rgba(249, 255, 50, 0.2);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
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
            background-color: var(--bubble-color);
            border-radius: 50%;
            animation: float 15s infinite linear;
            transition: background-color 0.3s ease;
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
            background: var(--card-bg);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--text-color);
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
            background-color: var(--panel-bg);
            color: var(--text-color);
        }

        .buscador:focus {
            border-color: var(--primary);
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
            background: var(--card-bg);
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
            background: var(--primary);
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

        /* Botón de modo oscuro */
        #botonModoOscuro {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 5px;
            border: none;
            background: transparent;
            cursor: pointer;
            z-index: 1000;
        }

        #botonModoOscuro img {
            width: 40px;
            height: 40px;
            transition: transform 0.3s ease;
        }

        #botonModoOscuro:hover img {
            transform: scale(1.1);
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

        .floating-element.popping {
            animation: none;
            transform: scale(calc(var(--bubble-size) * 1.5)) !important;
            background-color: #ff5722; /* Naranja brillante */
            box-shadow: 0 0 30px #ff5722, 0 0 60px #ff5722;
            filter: blur(0);
            z-index: 100;
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.4);
        }

        .floating-element.exploding {
            transform: scale(2);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .particle {
            position: absolute;
            background-color: #ffeb3b;
            border-radius: 50%;
            pointer-events: none;
            z-index: 200;
            box-shadow: 0 0 10px #fff, 0 0 20px currentColor;
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
                transform: scale(1);
                box-shadow: 0 0 10px 5px rgba(255, 87, 34, 0.5);
                opacity: 1;
            }
            100% {
                transform: scale(3);
                box-shadow: 0 0 50px 25px rgba(255, 87, 34, 0);
                opacity: 0;
            }
        }


        
        .shockwave {
            position: absolute;
            border-radius: 50%;
            z-index: 150;
            animation: shockwave 0.5s ease-out;
        }
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
            cursor: grab;
            user-select: none;
        }

        .floating-element:hover {
            animation-play-state: paused;
        }

        .floating-element.dragging {
            animation: none;
            cursor: grabbing;
            z-index: 10;
            filter: blur(0) !important;
            transform: scale(calc(var(--bubble-size) * 1.2));
            transition: transform 0.1s ease-out;
        }

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
        
    </style>
@stop

@section('content')
<!-- Botón de modo oscuro -->
<button id="botonModoOscuro" onclick="alternarModoOscuro()">
    <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema">
</button>

<div class="welcome-container">
    <div class="floating-elements">
        <!-- Elementos flotantes generados dinámicamente -->
    </div>
    
    <div class="welcome-content">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo Cooperativa Talanga" class="logo">
        <h1 class="saludo">Bienvenido a Cooperativa de Ahorro y Credito <span class="typing-effect">"Talanga" Limitada</span></h1>
        <p>Tu aliado financiero para un futuro más próspero. Juntos crecemos, juntos prosperamos.</p>
        <a href="{{ url('generador') }}" class="btn">Acceder al Generador</a>
        
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
                 data-img="{{ asset('vendor/adminlte/dist/img/diploma.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/diploma.png') }}" 
                     alt="Diploma Básico" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Diploma Básico</div>
                </div>
            </div>
            <a href="{{ url('generador') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma 1
            </a>
        </div>
        
           <!-- Diploma 5 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/general2.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/general2.png') }}" 
                     alt="Diploma General" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Diploma General</div>
                </div>
            </div>
            <a href="{{ url('general') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma General 2
            </a>
        </div> 

        <!-- Diploma 2 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/juventud.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/juventud.png') }}" 
                     alt="Diploma Juventud" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Juventud</div>
                </div>
            </div>
            <a href="{{ url('juventud') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar diploma para Comite de Juventud
            </a>
        </div>
        
        <!-- Diploma 3 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/genero.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/genero.png') }}" 
                     alt="Diploma Género" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Género</div>
                </div>
            </div>
            <a href="{{ url('genero') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar diploma para Comite de Genero
            </a>
        </div>
        
        <!-- Diploma 4 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/educacion.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/educacion.png') }}" 
                     alt="Diploma Educación" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Comité de Educación</div>
                </div>
            </div>
            <a href="{{ url('educacion') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar Diploma para Comite de Educacion
            </a>
        </div>
        
        <!-- Diploma 5 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/reconocimiento.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/reconocimiento.png') }}" 
                     alt="Certificado Reconocimiento" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Certificado Reconocimiento (extenso)</div>
                </div>
            </div>
            <a href="{{ url('reconocimiento') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar Certificado Reconocimiento(extenso)
            </a>
        </div>

        <!-- Diploma 6 -->
        <div class="diploma-item">
            <div class="imagen-container" 
                 data-img="{{ asset('vendor/adminlte/dist/img/participacion.png') }}">
                <img src="{{ asset('vendor/adminlte/dist/img/participacion.png') }}" 
                     alt="Certificado para Participantes(extenso)" 
                     class="imagen-preview">
                <div class="imagen-info">
                    <div class="imagen-titulo">Certificado para Participantes(extenso)</div>
                </div>
            </div>
            <a href="{{ url('participacion') }}" class="boton-link">
                <i class="fas fa-download"></i> Generar Certificado para Participantes(extenso)
            </a>
        </div>
        
    </div>
</div>
@endsection

@section('js')
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

    // Modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        // Cambiar ícono según el modo
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            // Actualizar burbujas para modo oscuro
            document.querySelectorAll('.floating-element').forEach(bubble => {
                bubble.style.backgroundColor = 'rgba(249, 255, 50, 0.2)';
            });
        } else {
            icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
            // Actualizar burbujas para modo claro
            document.querySelectorAll('.floating-element').forEach(bubble => {
                bubble.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
            });
        }
    }

    // Verificar modo oscuro al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            // Actualizar burbujas para modo oscuro
            document.querySelectorAll('.floating-element').forEach(bubble => {
                bubble.style.backgroundColor = 'rgba(249, 255, 50, 0.2)';
            });
        }
    });







    // Generar elementos flotantes con más variedad
    function generarBurbujas() {
        const bubblesContainer = document.getElementById('bubbles-container');
        bubblesContainer.innerHTML = '';
        
        const bubbleCount = 30;
        const colors = document.body.classList.contains('dark-mode') 
            ? ['rgba(248, 197, 55, 0.4)', 'rgba(249, 255, 50, 0.3)', 'rgba(255, 215, 0, 0.3)']
            : ['rgba(44, 94, 26, 0.2)', 'rgba(76, 154, 42, 0.2)', 'rgba(106, 176, 76, 0.2)'];
        
        for (let i = 0; i < bubbleCount; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('floating-element');
            
            const size = Math.random() * 100 + 20;
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
            
            // Efecto especial para modo oscuro
            if (document.body.classList.contains('dark-mode')) {
                bubble.style.boxShadow = `0 0 15px ${color}`;
                bubble.style.filter = 'blur(1px)';
            }
            
            bubblesContainer.appendChild(bubble);
        }
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

    // Modo oscuro con efectos dramáticos
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        // Cambiar ícono
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            icono.style.transform = 'rotate(360deg)';
        } else {
            icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
            icono.style.transform = 'rotate(0deg)';
        }
        
        // Regenerar burbujas con nuevos estilos
        generarBurbujas();
        
        // Efecto de transición dramática
        document.documentElement.style.setProperty('--bubble-transition', 'all 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55)');
    }

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
        }
        
        generarBurbujas();
        animateValue('members-count', 0, 7000, 2000, '+', '');
        animateValue('years-active', 0, 56, 2000, '', ' años');
    });

    // Variables globales
    let bubbles = [];
    let isDragging = false;
    let draggedBubble = null;
    let offsetX, offsetY;

    // Generar elementos flotantes
    function generarBurbujas() {
        const bubblesContainer = document.getElementById('bubbles-container');
        bubblesContainer.innerHTML = '';
        bubbles = [];
        
        const bubbleCount = 30;
        const colors = document.body.classList.contains('dark-mode') 
            ? ['rgba(248, 197, 55, 0.4)', 'rgba(249, 255, 50, 0.3)', 'rgba(255, 215, 0, 0.3)']
            : ['rgba(44, 94, 26, 0.2)', 'rgba(76, 154, 42, 0.2)', 'rgba(106, 176, 76, 0.2)'];
        
        for (let i = 0; i < bubbleCount; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('floating-element');
            
            const size = Math.random() * 100 + 20;
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
            bubble.dataset.originalColor = color;
            
            if (document.body.classList.contains('dark-mode')) {
                bubble.style.boxShadow = `0 0 15px ${color}`;
                bubble.style.filter = 'blur(1px)';
            }
            
            // Añadir eventos para arrastrar
            bubble.addEventListener('mousedown', startDrag);
            
            bubblesContainer.appendChild(bubble);
            bubbles.push({
                element: bubble,
                x: parseFloat(posX),
                y: -parseFloat(size),
                size: size,
                speed: 1 + Math.random()
            });
        }
    }

    // Comenzar a arrastrar
    function startDrag(e) {
        isDragging = true;
        draggedBubble = e.target;
        draggedBubble.classList.add('dragging');
        
        // Calcular offset entre el mouse y la posición de la burbuja
        const rect = draggedBubble.getBoundingClientRect();
        offsetX = e.clientX - rect.left;
        offsetY = e.clientY - rect.top;
        
        // Cambiar color al arrastrar
        const hue = Math.floor(Math.random() * 360);
        draggedBubble.style.backgroundColor = `hsla(${hue}, 80%, 60%, 0.7)`;
        draggedBubble.style.boxShadow = `0 0 20px hsla(${hue}, 80%, 60%, 0.7)`;
        
        e.preventDefault();
    }

    // Mover burbuja
    function dragBubble(e) {
        if (!isDragging) return;
        
        // Calcular nueva posición
        const x = e.clientX - offsetX;
        const y = e.clientY - offsetY;
        
        // Convertir a porcentajes
        const container = document.getElementById('bubbles-container');
        const rect = container.getBoundingClientRect();
        const percentX = (x / rect.width) * 100;
        const percentY = (y / rect.height) * 100;
        
        // Aplicar nueva posición
        draggedBubble.style.left = `${percentX}%`;
        draggedBubble.style.top = `${percentY}%`;
        draggedBubble.style.bottom = 'auto';
    }

    // Terminar de arrastrar
    function stopDrag() {
        if (!isDragging) return;
        
        isDragging = false;
        draggedBubble.classList.remove('dragging');
        
        // Restaurar color original
        draggedBubble.style.backgroundColor = draggedBubble.dataset.originalColor;
        draggedBubble.style.boxShadow = document.body.classList.contains('dark-mode') 
            ? `0 0 15px ${draggedBubble.dataset.originalColor}`
            : 'none';
            
        draggedBubble = null;
    }

    // Modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            icono.style.transform = 'rotate(360deg)';
        } else {
            icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
            icono.style.transform = 'rotate(0deg)';
        }
        
        generarBurbujas();
    }

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
        }
        
        generarBurbujas();
        animateValue('members-count', 0, 7000, 2000, '+', '');
        animateValue('years-active', 0, 56, 2000, '', ' años');
        
        // Eventos de arrastre
        document.addEventListener('mousemove', dragBubble);
        document.addEventListener('mouseup', stopDrag);
        document.addEventListener('mouseleave', stopDrag);
    });

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

    // Explotar burbuja con efecto previo
    function explodeBubble(e) {
        const bubble = e.target;
        const rect = bubble.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        
        // 1. Primero cambia a color brillante
        bubble.classList.add('popping');
        
        // 2. Pequeña pausa para el efecto visual
        setTimeout(() => {
            bubble.classList.remove('popping');
            bubble.classList.add('exploding');
            
            // 3. Crear partículas de explosión
            createParticles(rect.left + rect.width/2, rect.top + rect.height/2, size);
            
            // 4. Eliminar burbuja después de la animación
            setTimeout(() => {
                bubble.remove();
            }, 300);
        }, 100); // Breve pausa antes de la explosión
    }

    // Crear partículas de explosión mejoradas
    function createParticles(x, y, size) {
        const particlesContainer = document.getElementById('bubbles-container');
        const particleCount = Math.min(Math.floor(size / 3), 15); // Máximo 15 partículas
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            const particleSize = Math.random() * 4 + 2; // Partículas más pequeñas
            const angle = Math.random() * Math.PI * 2;
            const distance = Math.random() * size * 0.6 + 20; // Explosión más contenida
            const duration = Math.random() * 0.4 + 0.3; // Animación más rápida
            
            particle.style.width = `${particleSize}px`;
            particle.style.height = `${particleSize}px`;
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;
            
            // Variables CSS para la animación
            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;
            particle.style.setProperty('--tx', `${tx}px`);
            particle.style.setProperty('--ty', `${ty}px`);
            
            // Variación de color para algunas partículas
            if (Math.random() > 0.7) {
                particle.style.backgroundColor = '#ff9800'; // Naranja
            }
            
            particle.style.animation = `particle-explosion ${duration}s forwards`;
            
            particlesContainer.appendChild(particle);
            
            // Eliminar partícula después de la animación
            setTimeout(() => {
                particle.remove();
            }, duration * 1000);
        }
    }

    function createParticles(x, y, size) {
        const particlesContainer = document.getElementById('bubbles-container');
        const particleCount = Math.min(Math.floor(size / 2), 25); // Más partículas
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            const particleSize = Math.random() * 8 + 4; // Partículas más grandes
            const angle = Math.random() * Math.PI * 2;
            const distance = Math.random() * size * 1.2 + 30; // Mayor distancia
            const duration = Math.random() * 0.6 + 0.4; // Animación más lenta
            const color = Math.random() > 0.5 ? '#ffeb3b' : '#ff9800';
            
            particle.style.width = `${particleSize}px`;
            particle.style.height = `${particleSize}px`;
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;
            particle.style.backgroundColor = color;
            particle.style.color = color; // Para el box-shadow
            
            // Variables CSS para la animación
            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;
            particle.style.setProperty('--tx', `${tx}px`);
            particle.style.setProperty('--ty', `${ty}px`);
            
            particle.style.animation = `particle-explosion ${duration}s forwards`;
            
            particlesContainer.appendChild(particle);
            
            // Eliminar partícula después de la animación
            setTimeout(() => {
                particle.remove();
            }, duration * 1000);
        }
    }
// Variables globales
let bubbles = [];

// Generar elementos flotantes
function generarBurbujas() {
    const bubblesContainer = document.getElementById('bubbles-container');
    bubblesContainer.innerHTML = '';
    bubbles = [];
    
    const bubbleCount = 30;
    const colors = document.body.classList.contains('dark-mode') 
        ? ['rgba(248, 197, 55, 0.4)', 'rgba(249, 255, 50, 0.3)', 'rgba(255, 215, 0, 0.3)']
        : ['rgba(44, 94, 26, 0.2)', 'rgba(76, 154, 42, 0.2)', 'rgba(106, 176, 76, 0.2)'];
    
    for (let i = 0; i < bubbleCount; i++) {
        const bubble = document.createElement('div');
        bubble.classList.add('floating-element');
        
        const size = Math.random() * 100 + 20;
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
            bubble.style.boxShadow = `0 0 15px ${color}`;
            bubble.style.filter = 'blur(1px)';
        }
        
        // Añadir evento de clic para explosión
        bubble.addEventListener('click', function(e) {
            explodeBubble(e.target);
        });
        
        bubblesContainer.appendChild(bubble);
        bubbles.push({
            element: bubble,
            x: parseFloat(posX),
            y: -parseFloat(size),
            size: size,
            speed: 1 + Math.random()
        });
    }
}

// Explotar burbuja con efecto dramático
function explodeBubble(bubble) {
    const rect = bubble.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const container = document.getElementById('bubbles-container');
    
    // 1. Crear onda expansiva
    const shockwave = document.createElement('div');
    shockwave.classList.add('shockwave');
    shockwave.style.width = `${size}px`;
    shockwave.style.height = `${size}px`;
    shockwave.style.left = `${rect.left}px`;
    shockwave.style.top = `${rect.top}px`;
    document.body.appendChild(shockwave);
    
    // 2. Efecto de explosión en la burbuja
    bubble.classList.add('exploding');
    
    // 3. Crear partículas de explosión
    createParticles(rect.left + rect.width/2, rect.top + rect.height/2, size, bubble.dataset.color);
    
    // 4. Eliminar elementos después de la animación
    setTimeout(() => {
        bubble.remove();
        shockwave.remove();
    }, 500);
}

// Crear partículas de explosión dramática
function createParticles(x, y, size, color) {
    const particlesContainer = document.getElementById('bubbles-container');
    const particleCount = Math.min(Math.floor(size / 3), 20); // Más partículas
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        const particleSize = Math.random() * 8 + 4; // Partículas más grandes
        const angle = Math.random() * Math.PI * 2;
        const distance = Math.random() * size * 0.8 + 30; // Mayor distancia
        const duration = Math.random() * 0.5 + 0.5; // Animación más lenta
        
        particle.style.width = `${particleSize}px`;
        particle.style.height = `${particleSize}px`;
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;
        particle.style.backgroundColor = color || '#ffeb3b';
        
        // Variables CSS para la animación
        const tx = Math.cos(angle) * distance;
        const ty = Math.sin(angle) * distance;
        particle.style.setProperty('--tx', `${tx}px`);
        particle.style.setProperty('--ty', `${ty}px`);
        
        particle.style.animation = `particle-explosion ${duration}s forwards`;
        
        particlesContainer.appendChild(particle);
        
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
        icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
        icono.style.transform = 'rotate(360deg)';
    } else {
        icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
        icono.style.transform = 'rotate(0deg)';
    }
    
    generarBurbujas();
}

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark-mode');
        document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
    }
    
    generarBurbujas();
    animateValue('members-count', 0, 7000, 2000, '+', '');
    animateValue('years-active', 0, 56, 2000, '', ' años');
});

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
    
</script>
@endsection

@section('css')
    <style>
        .sidebar {
            font-size: 14px;
        }
    </style>
@endsection