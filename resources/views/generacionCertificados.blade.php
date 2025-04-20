@extends('adminlte::page')

@section('title', 'Generador de certificados')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Generador de Certificados</title>
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
            --certificado-bg-1: url('{{ asset("vendor/adminlte/dist/img/participacion.png") }}');
            --certificado-bg-2: url('{{ asset("vendor/adminlte/dist/img/reconocimiento.png") }}');
        }

        .dark-mode {
<<<<<<< HEAD
=======
            
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            --certificado-bg-1: url('{{ asset("vendor/adminlte/dist/img/participacion.png") }}');
            --certificado-bg-2: url('{{ asset("vendor/adminlte/dist/img/reconocimiento.png") }}');
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
<<<<<<< HEAD
=======
            
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
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

        .destacado {
            font-weight: bold;
            color: var(--highlight-color);
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

        .file-input-container {
            position: relative;
            display: inline-block;
        }

        .file-input-label {
            padding: 12px 25px;
            background-color: var(--primary);
            color: white;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .file-input-label:hover {
            background-color: var(--dark);
            transform: translateY(-2px);
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
            font-style: italic;
            color: var(--text-color);
        }

        .certificado-preview-container {
            position: relative;
            margin: 30px auto;
            text-align: center;
        }

        .certificado-preview {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .certificado-preview:hover {
            transform: scale(1.01);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .generated-certificates {
            display: none;
            margin-top: 40px;
        }

        .certificado-item {
            margin-bottom: 30px;
            text-align: center;
        }

        .certificado-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
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

        /* Estilos para los certificados */
        .certificado-1 {
            background-image: var(--certificado-bg-1);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .certificado-2 {
            background-image: var(--certificado-bg-2);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        /* Posicionamiento del texto en los certificados */
        .nombre-certificado {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 42px;
            text-align: center;
            font-family: 'Vivaldi', sans-serif;
            font-weight: bold;
            color: var(--nombre-color);
            width: 80%;
        }

        .texto-certificado {
            position: absolute;
            top: 65%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            text-align: center;
            color: var(--nombre-color);
            width: 80%;
            line-height: 1.5;
        }

        .fecha-certificado {
            position: absolute;
            top: 93%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            text-align: center;
            color: var(--nombre-color);
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
            
            /* Ajustes para móviles en los certificados */
            .certificado-1, .certificado-2 {
                width: 100%;
                height: auto;
                aspect-ratio: 297/210;
            }
            
            .nombre-certificado {
                font-size: 24px;
                top: 40%;
            }
            
            .texto-certificado {
                font-size: 14px;
                top: 60%;
            }
            
            .fecha-certificado {
                font-size: 12px;
                top: 80%;
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
        <i class="fas fa-certificate"></i> Generador de Certificados
    </h2>

    <!-- Instrucciones -->
    <div class="instructions">
        <h3><i class="fas fa-info-circle"></i> Instrucciones de uso:</h3>
        <ol>
            <li>Selecciona uno de los diseños de Certificados disponibles</li>
            <li>Descarga la plantilla CSV para conocer el formato requerido</li>
            <li>Llena la plantilla con los datos de los estudiantes</li>
            <li>Selecciona el archivo CSV completado</li>
            <li>Haz clic en "Generar Certificados"</li>
            <li>Descarga los diplomas individualmente o todos juntos en un ZIP</li>
        </ol>
<<<<<<< HEAD
        <p class="destacado">Para más de 100 certificados, se generarán múltiples archivos ZIP automáticamente.</p>
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    </div>

    <!-- Selector de diseño -->
    <div class="design-selector">
        <div class="design-option active" data-design="1">
            <img src="{{ asset('vendor/adminlte/dist/img/participacion.png') }}" class="design-preview" id="preview-design-1">
            <div class="design-name">Certificado de Participación</div>
        </div>
        <div class="design-option" data-design="2">
            <img src="{{ asset('vendor/adminlte/dist/img/reconocimiento.png') }}" class="design-preview" id="preview-design-2">
            <div class="design-name">Certificado de Reconocimiento</div>
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
            <span id="nombre-archivo">No se ha seleccionado archivo</span>
        </div>
        
        <div class="control-group">
            <button onclick="generarCertificados()" id="botonGenerar" class="btn" disabled>
                <i class="fas fa-magic"></i> Generar Certificados
            </button>
            <button onclick="descargarTodos()" id="botonDescargarTodos" class="btn" style="display: none;">
                <i class="fas fa-file-archive"></i> Descargar Todos (ZIP)
            </button>
        </div>
    </div>

    <!-- Vista previa del certificado -->
    <div class="certificado-preview-container">
        <img src="{{ asset('vendor/adminlte/dist/img/participacion.png') }}" id="certificado-preview" class="certificado-preview">
        <div style="margin-top: 10px; font-style: italic; color: var(--text-color); opacity: 0.8;">Vista previa del diseño seleccionado</div>
    </div>

    <!-- Certificados generados -->
    <div id="generated-certificates" class="generated-certificates">
        <h3 style="text-align: center; color: var(--primary); margin-bottom: 20px;">
            Certificados Generados
        </h3>
        
        <div class="certificado-controls">
            <button onclick="refrescarCertificados()" class="btn btn-info">
                <i class="fas fa-sync-alt"></i> Refrescar Certificados
            </button>
            <button onclick="eliminarCertificados()" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Eliminar Todos
            </button>
        </div>
        
        <div id="contenedor-certificados"></div>
<<<<<<< HEAD
        
        <!-- Sección para grupos de descarga cuando hay muchos certificados -->
        <div id="download-groups" style="display: none;">
            <h4 style="text-align: center; color: var(--primary); margin-top: 30px;">
                Grupos de Descarga
            </h4>
        </div>
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    </div>
</div>

<div class="fixed-buttons">
    <button onclick="refrescarCertificados()" class="btn btn-info">
        <i class="fas fa-sync-alt"></i> Refrescar Certificados
    </button>
    <button onclick="eliminarCertificados()" class="btn btn-danger">
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
    let participantes = [];
    let textoCertificado = '';
    let diseñoActual = '1';
    const imagenesDisenos = {
        '1': 'vendor/adminlte/dist/img/participacion.png',
        '2': 'vendor/adminlte/dist/img/reconocimiento.png'
    };
    const imagenesDisenosDark = {
        '1': 'vendor/adminlte/dist/img/participacion.png',
        '2': 'vendor/adminlte/dist/img/reconocimiento.png'
    };

    // Plantillas de generación para cada diseño
    const plantillasGeneracion = {
        '1': (participante) => `
            <div class="certificado-1" id="certificado-${participante.id}">
                <div class="nombre-certificado">${participante.nombre}</div>
                <div class="texto-certificado">${textoCertificado || 'Por su destacada participación y contribución en nuestro programa'}</div>
                <div class="fecha-certificado">Fecha: ${new Date().toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
            </div>
        `,
        '2': (participante) => `
            <div class="certificado-2" id="certificado-${participante.id}">
                <div class="nombre-certificado">${participante.nombre}</div>
                <div class="texto-certificado">${textoCertificado || 'Por su excelente desempeño y logros alcanzados'}</div>
                <div class="fecha-certificado">Fecha: ${new Date().toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
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
                actualizarVistaPrevia();
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
            actualizarVistaPrevia();
        }
    });

    function actualizarVistaPrevia() {
        const modoOscuro = document.body.classList.contains('dark-mode');
        const imagen = modoOscuro ? imagenesDisenosDark[diseñoActual] : imagenesDisenos[diseñoActual];
        document.getElementById('certificado-preview').src = imagen;
        document.getElementById(`preview-design-${diseñoActual}`).src = imagen;
    }

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
        
        actualizarVistaPrevia();
    }

    function procesarArchivoCSV(archivo) {
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Buscar texto del certificado
            const textoIndex = lineas.findIndex(linea => linea.startsWith('Texto a escribir en diploma:'));
            if (textoIndex !== -1) {
                textoCertificado = lineas[textoIndex].split(':')[1]?.trim() || '';
            }

            // Buscar nombres de participantes
            const nombresIndex = lineas.findIndex(linea => linea.startsWith('Nombre del participante'));
            participantes = [];
            
            if (nombresIndex !== -1) {
                for (let i = nombresIndex + 1; i < lineas.length; i++) {
                    if (lineas[i]) {
                        participantes.push({
                            id: i,
                            nombre: lineas[i].split(';')[0].trim()
                        });
                    }
                }
            }
            
            if (participantes.length === 0) {
                alert("No se encontraron participantes válidos en el archivo");
                document.getElementById('botonGenerar').disabled = true;
            } else {
                alert(`Se han cargado ${participantes.length} participantes correctamente`);
            }
        };
        
        lector.onerror = function() {
            alert("Error al leer el archivo");
            document.getElementById('botonGenerar').disabled = true;
        };
        
        lector.readAsArrayBuffer(archivo);
    }

    function descargarPlantilla() {
        const contenido = `Cooperativa de Ahorro y Crédito Talanga LTDA\n\nINSTRUCCIONES:\n1. Complete los datos del curso y tutor abajo\n2. Escriba el texto a escribir en el diploma a la par de la opción\n3. Escriba el nombre del participante a certificar en lista hacia abajo\n4. No use tildes ni modifique la estructura\n5. Guarde el archivo como CSV (delimitado por punto y coma)\n\nTexto a escribir en diploma:\nNombre del participante\nEjemplo Participante 1\nEjemplo Participante 2`;
        const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(blob);
        enlace.download = 'Plantilla_Certificado.csv';
        enlace.click();
    }

    function generarCertificados() {
        const contenedor = document.getElementById('contenedor-certificados');
        contenedor.innerHTML = '';
        
        participantes.forEach((participante, indice) => {
            const certificadoHTML = `
                <div class="certificado-item fade-in" style="animation-delay: ${indice * 0.1}s">
                    ${plantillasGeneracion[diseñoActual](participante)}
                    <button onclick="descargarCertificado(${indice})" class="btn" style="margin-top: 15px;">
                        <i class="fas fa-download"></i> Descargar Certificado ${indice + 1}
                    </button>
                </div>
            `;
            
            contenedor.innerHTML += certificadoHTML;
        });
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('generated-certificates').style.display = 'block';
        document.getElementById('botonGenerar').disabled = true;
        
<<<<<<< HEAD
        // Mostrar opción de grupos si hay muchos certificados
        if (participantes.length > 100) {
            document.getElementById('download-groups').style.display = 'block';
            crearBotonesGruposDescarga();
        }
        
        document.getElementById('generated-certificates').scrollIntoView({ behavior: 'smooth' });
    }

    function crearBotonesGruposDescarga() {
        const gruposContainer = document.getElementById('download-groups');
        gruposContainer.innerHTML = '';
        
        const groupSize = 100;
        const numGroups = Math.ceil(participantes.length / groupSize);
        
        for (let i = 0; i < numGroups; i++) {
            const start = i * groupSize;
            const end = start + groupSize;
            const grupo = participantes.slice(start, end);
            
            const groupDiv = document.createElement('div');
            groupDiv.className = 'download-group';
            groupDiv.innerHTML = `
                <p>Certificados ${start + 1} a ${Math.min(end, participantes.length)}</p>
                <button onclick="descargarGrupo(${start}, ${end})" class="btn">
                    <i class="fas fa-file-archive"></i> Descargar Grupo ${i + 1}
                </button>
            `;
            
            gruposContainer.appendChild(groupDiv);
        }
    }

    async function descargarGrupo(start, end) {
        const grupo = participantes.slice(start, end);
        await generarYDescargarZIP(grupo, `Certificados_${start + 1}-${Math.min(end, participantes.length)}`);
    }

=======
        document.getElementById('generated-certificates').scrollIntoView({ behavior: 'smooth' });
    }

>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
    async function descargarCertificado(indice) {
        try {
            const elemento = document.getElementById(`certificado-${participantes[indice].id}`);
            const lienzo = await html2canvas(elemento, { 
                scale: 2,
                logging: false,
                backgroundColor: null,
                useCORS: true,
                allowTaint: true
            });
            
            const enlace = document.createElement('a');
<<<<<<< HEAD
            enlace.download = `Certificado_${participantes[indice].nombre.replace(/[^a-z0-9]/gi, '_')}.png`;
=======
            enlace.download = `Certificado_${participantes[indice].nombre.replace(/ /g, '_')}.png`;
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            enlace.href = lienzo.toDataURL('image/png');
            enlace.click();
        } catch (error) {
            console.error('Error al generar certificado:', error);
            alert("Error al generar el certificado");
        }
    }

    function refrescarCertificados() {
        if (participantes.length > 0) {
            generarCertificados();
            alert("Certificados refrescados correctamente");
        } else {
            alert("No hay certificados para refrescar. Por favor, genera certificados primero.");
        }
    }

    function eliminarCertificados() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los certificados generados?")) {
            document.getElementById('contenedor-certificados').innerHTML = '';
            document.getElementById('botonDescargarTodos').style.display = 'none';
<<<<<<< HEAD
            document.getElementById('generated-certificates').style.display = 'none';
            document.getElementById('download-groups').style.display = 'none';
=======
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            document.getElementById('botonGenerar').disabled = false;
            participantes = [];
            textoCertificado = '';
            document.getElementById('nombre-archivo').textContent = 'No se ha seleccionado archivo';
            document.getElementById('archivoCSV').value = '';
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    async function descargarTodos() {
<<<<<<< HEAD
        if (participantes.length > 100) {
            if (confirm(`Para mejor rendimiento con ${participantes.length} certificados, se generarán múltiples archivos ZIP. ¿Continuar?`)) {
                crearBotonesGruposDescarga();
                document.getElementById('download-groups').style.display = 'block';
                document.getElementById('download-groups').scrollIntoView({ behavior: 'smooth' });
            }
            return;
        }
        
        await generarYDescargarZIP(participantes, 'Certificados_Completos');
    }

    async function generarYDescargarZIP(participantesGrupo, nombreArchivo) {
        try {
            // Configurar overlay de carga
=======
        try {
            // Crear overlay de carga
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            const overlay = document.createElement('div');
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="loading-content">
<<<<<<< HEAD
                    <h3>Generando archivo ZIP (${participantesGrupo.length} certificados)</h3>
                    <p>Por favor espere, esto puede tomar tiempo...</p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="zip-progress"></div>
                    </div>
                    <p id="progress-text">Procesando: 0/${participantesGrupo.length}</p>
                    <p id="memory-status"></p>
=======
                    <h3>Generando archivo ZIP</h3>
                    <p>Por favor espere, esto puede tomar varios minutos...</p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="zip-progress"></div>
                    </div>
                    <p id="progress-text">0/${participantes.length} certificados procesados</p>
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
                </div>
            `;
            document.body.appendChild(overlay);
            
<<<<<<< HEAD
            const progressBar = document.getElementById('zip-progress');
            const progressText = document.getElementById('progress-text');
            const memoryStatus = document.getElementById('memory-status');
            
            // Configurar ZIP
            const archivoZip = new JSZip();
            const folder = archivoZip.folder("Certificados");
            
            // Procesar en lotes pequeños para mejor rendimiento
            const batchSize = 10;
            let processed = 0;
            let lastMemoryCheck = performance.now();
            
            for (let i = 0; i < participantesGrupo.length; i += batchSize) {
                // Verificar memoria periódicamente
                if (performance.now() - lastMemoryCheck > 2000) {
                    if (performance.memory) {
                        memoryStatus.textContent = `Memoria usada: ${Math.round(performance.memory.usedJSHeapSize / 1024 / 1024)}MB`;
                    }
                    lastMemoryCheck = performance.now();
                }
                
                const batch = participantesGrupo.slice(i, i + batchSize);
                const batchPromises = batch.map(async (participante) => {
                    const elemento = document.getElementById(`certificado-${participante.id}`);
                    
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
                        nombre: `Certificado_${participante.nombre.replace(/[^a-z0-9]/gi, '_')}.png`,
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
                processed = Math.min(i + batchSize, participantesGrupo.length);
                const progress = Math.round((processed / participantesGrupo.length) * 100);
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `Procesando: ${processed}/${participantesGrupo.length} (${progress}%)`;
                
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
=======
            const botonDescargar = document.getElementById('botonDescargarTodos');
            botonDescargar.disabled = true;
            botonDescargar.textContent = 'Generando...';
            
            const archivoZip = new JSZip();
            const folder = archivoZip.folder("Certificados");
            const progressBar = document.getElementById('zip-progress');
            const progressText = document.getElementById('progress-text');
            
            // Procesar en lotes de 3 para mejor rendimiento
            const batchSize = 3;
            let processed = 0;
            
            for (let i = 0; i < participantes.length; i += batchSize) {
                const batch = participantes.slice(i, i + batchSize);
                const batchPromises = batch.map(async (participante, batchIndex) => {
                    const indice = i + batchIndex;
                    const elemento = document.getElementById(`certificado-${indice}`);
                    
                    const lienzo = await html2canvas(elemento, { 
                        useCORS: true, 
                        scale: 1.5,
                        backgroundColor: null,
                        logging: false
                    });
                    
                    return {
                        nombre: `Certificado_${participante.nombre.replace(/ /g, '_')}.png`,
                        datos: lienzo.toDataURL('image/png', 0.8)
                    };
                });
                
                const batchResults = await Promise.all(batchPromises);
                
                batchResults.forEach(certificado => {
                    const datosBase64 = certificado.datos.split(',')[1];
                    folder.file(certificado.nombre, datosBase64, { base64: true });
                });
                
                processed = Math.min(i + batchSize, participantes.length);
                const progressPercent = (processed / participantes.length) * 100;
                
                progressBar.style.width = `${progressPercent}%`;
                progressText.textContent = `${processed}/${participantes.length} certificados procesados`;
                
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
            enlace.download = "Certificados.zip";
            enlace.click();
            
            // Limpiar
            document.body.removeChild(overlay);
            botonDescargar.disabled = false;
            botonDescargar.textContent = 'Descargar Todos (ZIP)';
            
        } catch (error) {
            console.error('Error al generar ZIP:', error);
            alert("Error al generar el archivo ZIP. Por favor intente con menos certificados o recargue la página.");
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
            
            // Limpiar en caso de error
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) document.body.removeChild(overlay);
<<<<<<< HEAD
=======
            
            const botonDescargar = document.getElementById('botonDescargarTodos');
            if (botonDescargar) {
                botonDescargar.disabled = false;
                botonDescargar.textContent = 'Descargar Todos (ZIP)';
            }
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
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