@extends('adminlte::page')

@section('title', 'Generador de diplomas')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Generador de Diplomas</title>
    <style>
        :root {
            --primary: #2c5e1a;
            --secondary: #f8c537;
            --light: #f5f7fa;
            --dark: #1e293b;
            --hover-yellow: #f9ff32;
            --danger: #e74c3c;
            --info: #3498db;
            --bg-color: #ffffff;
            --text-color: #333333;
            --panel-bg: #bdf1c6;
            --nombre-color: #2c3e50;
            --tutor-color: #0d0e0d;
            --border-color: #ddd;
            --highlight-color: #e74c3c;
            --progress-bg: #285430;
        }

        .dark-mode {
            --primary: #4a8c2a;
            --secondary: #f8c537;
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --panel-bg: #2d3748;
            --nombre-color: #f8c537;
            --tutor-color: #e0e0e0;
            --border-color: #444;
            --highlight-color: #f8c537;
            --progress-bg: #f8c537;
            --light: #2d3748;
            --dark: #f5f7fa;
            
            --button-bg: #285430;
            --button-hover: #112214;
            --panel-bg:rgb(44, 65, 49);
            --nombre-color: #000;
            --secondary-color: #285430;
            --tutor-color: #0d0e0d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.5s, color 0.5s;
            padding-bottom: 150px;
        }

        .generator-container {
            max-width: 1200px;
            margin: 20px auto;
            background: var(--bg-color);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.5s;
        }

        .fixed-buttons {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--panel-bg);
            padding: 15px 30px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            gap: 15px;
            transition: all 0.5s;
        }

        .instructions {
            background-color: var(--panel-bg);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid var(--primary);
            transition: all 0.5s;
        }

        .instructions h3 {
            color: var(--primary);
            margin-top: 0;
        }

        .instructions ol {
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 10px;
        }

        .design-selector {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            position: sticky;
            top: 20px;
            background: var(--bg-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 100;
            transition: all 0.5s;
        }

        .design-option {
            width: 180px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .design-option:hover {
            transform: translateY(-5px);
        }

        .design-preview {
            width: 100%;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid transparent;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .design-option:hover .design-preview {
            border-color: var(--secondary);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .design-option.active .design-preview {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--secondary);
        }

        .design-name {
            margin-top: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        .controls-section {
            background: var(--panel-bg);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            transition: all 0.5s;
        }

        .control-group {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--primary);
            color: white;
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
            background-color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: var(--primary);
        }

        .btn-secondary:hover {
            background-color: var(--hover-yellow);
        }

        .btn-danger {
            background-color: var(--danger);
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-info {
            background-color: var(--info);
        }

        .btn-info:hover {
            background-color: #2980b9;
        }

        .diploma-preview-container {
            position: relative;
            margin: 30px auto;
            text-align: center;
        }

        .diploma-preview {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .diploma-preview:hover {
            transform: scale(1.01);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .generated-diplomas {
            margin-top: 40px;
        }

        .diploma-item {
            margin-bottom: 30px;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Estilos para los diplomas */
        .diploma-1 {
            background-image: url('{{ asset("vendor/adminlte/dist/img/diploma.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-2 {
            background-image: url('{{ asset("vendor/adminlte/dist/img/general2.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-3 {
            background-image: url('{{ asset("vendor/adminlte/dist/img/juventud.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-4 {
            background-image: url('{{ asset("vendor/adminlte/dist/img/genero.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-5 {
            background-image: url('{{ asset("vendor/adminlte/dist/img/educacion.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        /* Posicionamiento del texto en los diplomas */
        .nombre {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            text-align: center;
            font-family: 'Vivaldi', serif;
            color: var(--nombre-color);
        }

        .curso {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: var(--nombre-color);
        }

        .modalidad {
            position: absolute;
            top: 56%;
            left: 43%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: var(--nombre-color);
        }

        .duracion {
            position: absolute;
            top: 56%;
            left: 73%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: var(--nombre-color);
        }

        .fecha-finalizacion {
            position: absolute;
            top: 62%;
            left: 58%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: var(--nombre-color);
        }

        .fecha-emision {
            position: absolute;
            top: 66%;
            left: 50%;
            font-size: 20px;
            color: var(--nombre-color);
        }

        .tutor {
            position: absolute;
            top: 81%;
            left: 65%;
            font-size: 20px;
            color: var(--tutor-color);
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

        #iconoTema {
            width: 40px;
            height: 40px;
            transition: transform 0.5s, filter 0.3s;
        }

        #botonModoOscuro:hover #iconoTema {
            filter: brightness(1.2);
            transform: scale(1.1);
        }

        /* Estilos para el input de archivo */
        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-input-label {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--info);
            color: white;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .file-input-label:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        #archivoCSV {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        #nombre-archivo {
            margin-left: 10px;
            color: var(--text-color);
        }

        /* Estilos para el modal de carga */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-content {
            background: var(--panel-bg);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            color: var(--text-color);
            max-width: 80%;
        }
        
        .progress-bar-container {
            width: 100%;
            background-color: var(--bg-color);
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 20px;
            background-color: var(--progress-bg);
            border-radius: 5px;
            width: 0%;
            transition: width 0.3s;
        }

<<<<<<< HEAD
        /* Estilos para grupos de descarga */
        .download-group {
            margin: 20px 0;
            padding: 15px;
            background: var(--panel-bg);
            border-radius: 10px;
        }

=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
        @media (max-width: 768px) {
            .design-option {
                width: 150px;
            }
            
            .control-group {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .fixed-buttons {
                width: 90%;
                flex-direction: column;
                align-items: center;
            }
            
            .diploma-1, .diploma-2, .diploma-3, .diploma-4, .diploma-5 {
                width: 100%;
                height: auto;
                aspect-ratio: 297/210;
            }
            
            .nombre {
                font-size: 24px;
                top: 40%;
            }
            
            .curso {
                font-size: 18px;
                top: 25%;
            }
            
            .modalidad, .duracion, .fecha-finalizacion, .fecha-emision, .tutor {
                font-size: 14px;
            }
            
            #botonModoOscuro {
                top: 10px;
                right: 10px;
            }

            #iconoTema {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>

<div class="generator-container">
    <!-- Botón de modo oscuro -->
    <button id="botonModoOscuro" onclick="alternarModoOscuro()">
        <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema">
    </button>

    <h2 style="text-align: center; color: var(--primary); margin-bottom: 30px;">
        <i class="fas fa-certificate"></i> Generador de Diplomas
    </h2>

    <!-- Instrucciones -->
    <div class="instructions">
        <h3><i class="fas fa-info-circle"></i> Instrucciones de uso:</h3>
        <ol>
            <li>Selecciona uno de los diseños de diploma disponibles</li>
            <li>Descarga la plantilla CSV para conocer el formato requerido</li>
            <li>Llena la plantilla con los datos de los estudiantes</li>
            <li>Selecciona el archivo CSV completado</li>
            <li>Haz clic en "Generar Diplomas"</li>
            <li>Descarga los diplomas individualmente o todos juntos en un ZIP</li>
        </ol>
<<<<<<< HEAD
        <p class="destacado">Para más de 100 diplomas, se generarán múltiples archivos ZIP automáticamente.</p>
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    </div>

    <!-- Selector de diseño -->
    <div class="design-selector">
        <div class="design-option active" data-design="1">
            <img src="{{ asset('vendor/adminlte/dist/img/diploma.png') }}" class="design-preview">
            <div class="design-name">Diploma 1</div>
        </div>
        <div class="design-option" data-design="2">
            <img src="{{ asset('vendor/adminlte/dist/img/general2.png') }}" class="design-preview">
            <div class="design-name">Diploma 2</div>
        </div>
        <div class="design-option" data-design="3">
            <img src="{{ asset('vendor/adminlte/dist/img/juventud.png') }}" class="design-preview">
            <div class="design-name">Comité Juventud</div>
        </div>
        <div class="design-option" data-design="4">
            <img src="{{ asset('vendor/adminlte/dist/img/genero.png') }}" class="design-preview">
            <div class="design-name">Comité Género</div>
        </div>
        <div class="design-option" data-design="5">
            <img src="{{ asset('vendor/adminlte/dist/img/educacion.png') }}" class="design-preview">
            <div class="design-name">Comité Educación</div>
        </div>
    </div>

    <!-- Sección de controles -->
    <div class="controls-section">
        <div class="control-group">
            <button onclick="descargarPlantilla()" class="btn btn-secondary">
                <i class="fas fa-download"></i> Descargar Plantilla CSV
            </button>
        </div>
        
        <div class="control-group">
            <div class="file-input-container">
                <label for="archivoCSV" class="file-input-label">
                    <i class="fas fa-file-upload"></i> Seleccionar Archivo CSV
                </label>
                <input type="file" id="archivoCSV" accept=".csv">
            </div>
            <span id="nombre-archivo" style="margin-left: 10px;">No se ha seleccionado archivo</span>
        </div>
        
        <div class="control-group">
            <button onclick="generarDiplomas()" id="botonGenerar" class="btn" disabled>
                <i class="fas fa-magic"></i> Generar Diplomas
            </button>
            <button onclick="descargarTodos()" id="botonDescargarTodos" class="btn" style="display: none;">
                <i class="fas fa-file-archive"></i> Descargar Todos (ZIP)
            </button>
        </div>
    </div>

    <!-- Vista previa del diploma -->
    <div class="diploma-preview-container">
        <img src="{{ asset('vendor/adminlte/dist/img/diploma.png') }}" id="diploma-preview" class="diploma-preview">
        <div style="margin-top: 10px; font-style: italic; color: var(--text-color); opacity: 0.8;">Vista previa del diseño seleccionado</div>
    </div>

    <!-- Diplomas generados -->
    <div id="generated-diplomas" class="generated-diplomas">
        <h3 style="text-align: center; color: var(--primary); margin-bottom: 20px;">
            Diplomas Generados
        </h3>
        
        <div id="contenedor-diplomas"></div>
<<<<<<< HEAD
        
        <!-- Sección para grupos de descarga cuando hay muchos diplomas -->
        <div id="download-groups" style="display: none;">
            <h4 style="text-align: center; color: var(--primary); margin-top: 30px;">
                Grupos de Descarga
            </h4>
        </div>
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    </div>
</div>

<!-- Botones fijos en la parte inferior -->
<div class="fixed-buttons">
    <button onclick="refrescarDiplomas()" class="btn btn-info">
        <i class="fas fa-sync-alt"></i> Refrescar Diplomas
    </button>
    <button onclick="eliminarDiplomas()" class="btn btn-danger">
        <i class="fas fa-trash-alt"></i> Eliminar Todos
    </button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<<<<<<< HEAD
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7

<script>
    // Variables globales
    let estudiantes = [];
    let diseñoActual = '1';
    const imagenesDisenos = {
        '1': 'vendor/adminlte/dist/img/diploma.png',
        '2': 'vendor/adminlte/dist/img/general2.png',
        '3': 'vendor/adminlte/dist/img/juventud.png',
        '4': 'vendor/adminlte/dist/img/genero.png',
        '5': 'vendor/adminlte/dist/img/educacion.png'
    };

    // Plantillas de generación para cada diseño
    const plantillasGeneracion = {
        '1': (estudiante) => `
            <div class="diploma-1" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
            </div>
        `,
        '2': (estudiante) => `
            <div class="diploma-2" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
            </div>
        `,
        '3': (estudiante) => `
            <div class="diploma-3" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
            </div>
        `,
        '4': (estudiante) => `
            <div class="diploma-4" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
            </div>
        `,
        '5': (estudiante) => `
            <div class="diploma-5" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
            </div>
        `
    };

    // Inicializar eventos
    document.addEventListener('DOMContentLoaded', function() {
        // Selector de diseño
        document.querySelectorAll('.design-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.design-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                diseñoActual = this.getAttribute('data-design');
                document.getElementById('diploma-preview').src = imagenesDisenos[diseñoActual];
            });
        });

        // Cambio de archivo CSV
        document.getElementById('archivoCSV').addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                document.getElementById('nombre-archivo').textContent = archivo.name;
                document.getElementById('botonGenerar').disabled = false;
                procesarArchivoCSV(archivo);
            }
        });

        // Verificar modo oscuro al cargar
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
        }
    });

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
    }

    function procesarArchivoCSV(archivo) {
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            // Eliminar contenido duplicado (todo después de =======)
            const contenidoUnico = texto.split('=======')[0];
            const lineas = contenidoUnico.split('\n').map(linea => linea.trim()).filter(linea => linea !== '');
            
            let metadatos = {
                curso: '',
                tutor: '',
                fechaFinalizacion: '',
                modalidad: '',
                duracion: ''
            };

            // Procesar metadatos
            lineas.forEach(linea => {
                const celdas = linea.split(';').map(c => c.trim());
                if (celdas[0] === 'Curso:') metadatos.curso = celdas[1] || '';
                if (celdas[0] === 'Tutor:') metadatos.tutor = celdas[1] || '';
                if (celdas[0] === 'Fecha de finalizacion:') metadatos.fechaFinalizacion = celdas[1] || '';
                if (celdas[0] === 'Modalidad:') metadatos.modalidad = celdas[1] || '';
                if (celdas[0] === 'Duracion:') metadatos.duracion = celdas[1] || '';
            });

            // Verificar que todos los metadatos estén presentes
            if (!metadatos.curso || !metadatos.tutor || !metadatos.fechaFinalizacion || !metadatos.modalidad || !metadatos.duracion) {
                alert("Error: El archivo CSV no contiene todos los metadatos necesarios (Curso, Tutor, Fecha de Finalización, Modalidad, Duración)");
                return;
            }

            // Buscar la línea que contiene "Nombre;Nota Final"
            const indiceEncabezado = lineas.findIndex(linea => linea.includes('Nombre;Nota Final'));
            if (indiceEncabezado === -1) {
                alert("Error: El CSV no tiene la cabecera 'Nombre;Nota Final'");
                return;
            }

            estudiantes = [];
            // Procesar desde la línea siguiente al encabezado hasta el final
            for (let i = indiceEncabezado + 1; i < lineas.length; i++) {
                const celdas = lineas[i].split(';').map(c => c.trim());
                const nombre = celdas[0];
                
                // Solo procesar si hay un nombre válido (no vacío y no comienza con caracteres especiales)
                if (nombre && nombre.length > 0 && !nombre.startsWith(';;') && !nombre.startsWith('===')) {
                    estudiantes.push({
                        id: i,
                        nombreCompleto: nombre,
                        curso: metadatos.curso,
                        tutor: metadatos.tutor,
                        fechaFinalizacion: metadatos.fechaFinalizacion,
                        modalidad: metadatos.modalidad,
                        duracion: metadatos.duracion,
                        fechaEmision: new Date().toLocaleDateString('es-ES', { 
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        })
                    });
                }
            }
            
            if (estudiantes.length > 0) {
                alert(`Se han cargado ${estudiantes.length} estudiantes correctamente`);
            } else {
                alert("No se encontraron estudiantes en el archivo CSV");
            }
        };
        lector.readAsArrayBuffer(archivo);
    }

    function descargarPlantilla() {
        const contenido = `Cooperativa de Ahorro y Crédito Talanga LTDA

INSTRUCCIONES:
1. Complete los datos del curso abajo
2. Escriba los nombres de los participantes en la lista
3. No use tildes ni modifique la estructura
4. Guarde el archivo como CSV (delimitado por punto y coma)

Curso:;Nombre del curso
Tutor:;Nombre del tutor
Tipo Documento:;Certificado
Modalidad:;Presencial/Virtual
Duracion:;X horas
Fecha de finalizacion:;DD/MM/AAAA

Alumnos Aprobados
Nombre;Nota Final
Nombre Apellido1 Apellido2;
Nombre Apellido1 Apellido2;`;

        const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(blob);
        enlace.download = 'Plantilla_Diploma.csv';
        enlace.click();
    }

    function generarDiplomas() {
        const contenedor = document.getElementById('contenedor-diplomas');
        contenedor.innerHTML = '';
        
        if (estudiantes.length === 0) {
            alert("No hay estudiantes para generar diplomas");
            return;
        }

        estudiantes.forEach((estudiante, indice) => {
            let diplomaHTML = `
                <div class="diploma-item fade-in" style="animation-delay: ${indice * 0.1}s">
                    ${plantillasGeneracion[diseñoActual](estudiante)}
                    <button onclick="descargarDiploma(${indice})" class="btn" style="margin-top: 15px;">
                        <i class="fas fa-download"></i> Descargar Diploma ${indice + 1}
                    </button>
                </div>
            `;
            
            contenedor.innerHTML += diplomaHTML;
        });
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('generated-diplomas').style.display = 'block';
        document.getElementById('botonGenerar').disabled = true;
        
<<<<<<< HEAD
        // Mostrar opción de grupos si hay muchos diplomas
        if (estudiantes.length > 100) {
            document.getElementById('download-groups').style.display = 'block';
            crearBotonesGruposDescarga();
        }
        
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
        // Scroll a la sección de diplomas generados
        document.getElementById('generated-diplomas').scrollIntoView({ behavior: 'smooth' });
    }

<<<<<<< HEAD
    function crearBotonesGruposDescarga() {
        const gruposContainer = document.getElementById('download-groups');
        gruposContainer.innerHTML = '';
        
        const groupSize = 100;
        const numGroups = Math.ceil(estudiantes.length / groupSize);
        
        for (let i = 0; i < numGroups; i++) {
            const start = i * groupSize;
            const end = start + groupSize;
            const grupo = estudiantes.slice(start, end);
            
            const groupDiv = document.createElement('div');
            groupDiv.className = 'download-group';
            groupDiv.innerHTML = `
                <p>Diplomas ${start + 1} a ${Math.min(end, estudiantes.length)}</p>
                <button onclick="descargarGrupo(${start}, ${end})" class="btn">
                    <i class="fas fa-file-archive"></i> Descargar Grupo ${i + 1}
                </button>
            `;
            
            gruposContainer.appendChild(groupDiv);
        }
    }

    async function descargarGrupo(start, end) {
        const grupo = estudiantes.slice(start, end);
        await generarYDescargarZIP(grupo, `Diplomas_${start + 1}-${Math.min(end, estudiantes.length)}`);
    }

=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    async function descargarDiploma(indice) {
        try {
            const elemento = document.getElementById(`diploma-${estudiantes[indice].id}`);
            const lienzo = await html2canvas(elemento, { 
                useCORS: true,
                scale: 2,
                logging: false,
<<<<<<< HEAD
                allowTaint: true,
                removeContainer: true
            });
            
            const enlace = document.createElement('a');
            enlace.download = `Diploma_${estudiantes[indice].nombreCompleto.replace(/[^a-z0-9]/gi, '_')}.png`;
=======
                allowTaint: true
            });
            
            const enlace = document.createElement('a');
            enlace.download = `Diploma_${estudiantes[indice].nombreCompleto.replace(/ /g, '_')}.png`;
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            enlace.href = lienzo.toDataURL('image/png');
            enlace.click();
        } catch (error) {
            console.error('Error al generar diploma:', error);
            alert("Error al generar el diploma");
        }
    }
    
    async function descargarTodos() {
<<<<<<< HEAD
        if (estudiantes.length > 100) {
            if (confirm(`Para mejor rendimiento con ${estudiantes.length} diplomas, se generarán múltiples archivos ZIP. ¿Continuar?`)) {
                crearBotonesGruposDescarga();
                document.getElementById('download-groups').style.display = 'block';
                document.getElementById('download-groups').scrollIntoView({ behavior: 'smooth' });
            }
            return;
        }
        
        await generarYDescargarZIP(estudiantes, 'Diplomas_Completos');
    }

    async function generarYDescargarZIP(estudiantesGrupo, nombreArchivo) {
        try {
            // Configurar overlay de carga
            const overlay = document.createElement('div');
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="loading-content">
                    <h3>Generando archivo ZIP (${estudiantesGrupo.length} diplomas)</h3>
                    <p>Por favor espere, esto puede tomar tiempo...</p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="zip-progress"></div>
                    </div>
                    <p id="progress-text">Procesando: 0/${estudiantesGrupo.length}</p>
                    <p id="memory-status"></p>
                </div>
            `;
            document.body.appendChild(overlay);
            
            const progressBar = document.getElementById('zip-progress');
            const progressText = document.getElementById('progress-text');
            const memoryStatus = document.getElementById('memory-status');
            
            // Configurar ZIP
            const archivoZip = new JSZip();
            const folder = archivoZip.folder("Diplomas");
            
            // Procesar en lotes pequeños para mejor rendimiento
            const batchSize = 10;
            let processed = 0;
            let lastMemoryCheck = performance.now();
            
            for (let i = 0; i < estudiantesGrupo.length; i += batchSize) {
                // Verificar memoria periódicamente
                if (performance.now() - lastMemoryCheck > 2000) {
                    if (performance.memory) {
                        memoryStatus.textContent = `Memoria usada: ${Math.round(performance.memory.usedJSHeapSize / 1024 / 1024)}MB`;
                    }
                    lastMemoryCheck = performance.now();
                }
                
                const batch = estudiantesGrupo.slice(i, i + batchSize);
                const batchPromises = batch.map(async (estudiante) => {
                    const elemento = document.getElementById(`diploma-${estudiante.id}`);
                    
                    // Configuración optimizada de html2canvas
                    const canvas = await html2canvas(elemento, {
                        scale: 1,
                        quality: 0.7,
                        logging: false,
                        useCORS: true,
                        backgroundColor: null,
                        cacheBust: true,
                        removeContainer: true
                    });
                    
                    return {
                        nombre: `Diploma_${estudiante.nombreCompleto.replace(/[^a-z0-9]/gi, '_')}.png`,
                        data: canvas.toDataURL('image/png', 0.7)
                    };
                });
                
                // Procesar lote actual
                const batchResults = await Promise.all(batchPromises);
                
                // Agregar al ZIP
                batchResults.forEach(result => {
                    const base64Data = result.data.split(',')[1];
                    folder.file(result.nombre, base64Data, { base64: true });
                });
                
                // Actualizar progreso
                processed = Math.min(i + batchSize, estudiantesGrupo.length);
                const progress = Math.round((processed / estudiantesGrupo.length) * 100);
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `Procesando: ${processed}/${estudiantesGrupo.length} (${progress}%)`;
                
                // Pequeña pausa para liberar recursos
                await new Promise(resolve => setTimeout(resolve, 100));
            }
            
            // Generar ZIP con compresión mejorada
            const content = await archivoZip.generateAsync({
                type: "blob",
                compression: "DEFLATE",
                compressionOptions: { level: 6 },
                streamFiles: true
            }, ({ percent }) => {
                progressText.textContent = `Compresión: ${Math.round(percent)}%`;
            });
            
            // Descargar usando FileSaver.js
            saveAs(content, `${nombreArchivo}.zip`);
            
            // Limpiar
            document.body.removeChild(overlay);
            
        } catch (error) {
            console.error('Error generando ZIP:', error);
            alert(`Error: ${error.message || 'Problema al generar el archivo'}`);
            
            // Limpiar en caso de error
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) {
                document.body.removeChild(overlay);
=======
        try {
            // Mostrar mensaje de carga
            const loadingOverlay = document.createElement('div');
            loadingOverlay.className = 'loading-overlay';
            loadingOverlay.innerHTML = `
                <div class="loading-content">
                    <h3>Generando archivo ZIP</h3>
                    <p>Por favor espere, esto puede tomar varios minutos...</p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="progress-bar"></div>
                    </div>
                    <p id="progress-text">0/${estudiantes.length} diplomas procesados</p>
                </div>
            `;
            document.body.appendChild(loadingOverlay);
            
            const archivoZip = new JSZip();
            const folder = archivoZip.folder("Diplomas");
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            
            // Procesar en lotes para mejor rendimiento
            const batchSize = 3;
            let processed = 0;
            
            for (let i = 0; i < estudiantes.length; i += batchSize) {
                const batch = estudiantes.slice(i, i + batchSize);
                const batchPromises = batch.map(async (estudiante, batchIndex) => {
                    const indice = i + batchIndex;
                    const elemento = document.getElementById(`diploma-${estudiante.id}`);
                    
                    const lienzo = await html2canvas(elemento, { 
                        useCORS: true,
                        scale: 1.5,
                        logging: false,
                        allowTaint: true
                    });
                    
                    return {
                        nombre: `Diploma_${estudiante.nombreCompleto.replace(/ /g, '_')}.png`,
                        datos: lienzo.toDataURL('image/png', 0.8)
                    };
                });
                
                const batchResults = await Promise.all(batchPromises);
                
                batchResults.forEach(diploma => {
                    const datosBase64 = diploma.datos.split(',')[1];
                    folder.file(diploma.nombre, datosBase64, { base64: true });
                });
                
                processed = Math.min(i + batchSize, estudiantes.length);
                const progressPercent = (processed / estudiantes.length) * 100;
                
                progressBar.style.width = `${progressPercent}%`;
                progressText.textContent = `${processed}/${estudiantes.length} diplomas procesados`;
                
                // Pequeña pausa entre lotes para evitar bloqueo del navegador
                await new Promise(resolve => setTimeout(resolve, 100));
            }
            
            // Compresión mejorada
            const contenido = await archivoZip.generateAsync({ 
                type: "blob",
                compression: "DEFLATE",
                compressionOptions: { level: 6 }
            });
            
            const enlace = document.createElement('a');
            enlace.href = URL.createObjectURL(contenido);
            enlace.download = "Diplomas.zip";
            enlace.click();
            
            // Eliminar overlay de carga
            document.body.removeChild(loadingOverlay);
            
        } catch (error) {
            console.error('Error al generar ZIP:', error);
            alert("Error al generar el archivo ZIP. Por favor intente con menos diplomas o recargue la página.");
            
            // Eliminar overlay de carga en caso de error
            const loadingOverlay = document.querySelector('.loading-overlay');
            if (loadingOverlay) {
                document.body.removeChild(loadingOverlay);
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            }
        }
    }

    function refrescarDiplomas() {
        if (estudiantes.length > 0) {
            generarDiplomas();
        } else {
            alert("No hay diplomas para refrescar. Por favor, genera diplomas primero.");
        }
    }

    function eliminarDiplomas() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los diplomas generados?")) {
            document.getElementById('contenedor-diplomas').innerHTML = '';
            document.getElementById('botonDescargarTodos').style.display = 'none';
<<<<<<< HEAD
            document.getElementById('download-groups').style.display = 'none';
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            document.getElementById('botonGenerar').disabled = false;
            estudiantes = [];
            document.getElementById('nombre-archivo').textContent = 'No se ha seleccionado archivo';
            document.getElementById('archivoCSV').value = '';
        }
    }
</script>
</body>
</html>
@stop

@section('css')
    <style>
        .sidebar {
            font-size: 14px;
        }
    </style>
@endsection