<?php $__env->startSection('title', 'Generador de diplomas'); ?>

<?php $__env->startSection('content'); ?>
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
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --panel-bg: #2d2d2d;
            --nombre-color: #c0c0c0;
            --tutor-color: #e0e0e0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
            padding-bottom: 100px;
        }

        .generator-container {
            max-width: 1200px;
            margin: 20px auto;
            background: var(--bg-color);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        }

        .instructions {
            background-color: rgba(44, 94, 26, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid var(--primary);
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
            background: rgba(44, 94, 26, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            background-color: var(--panel-bg);
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
            background-color: #3a7a24;
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
            background-image: url('<?php echo e(asset("vendor/adminlte/dist/img/diploma.png")); ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-2 {
            background-image: url('<?php echo e(asset("vendor/adminlte/dist/img/general2.png")); ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-3 {
            background-image: url('<?php echo e(asset("vendor/adminlte/dist/img/juventud.png")); ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-4 {
            background-image: url('<?php echo e(asset("vendor/adminlte/dist/img/genero.png")); ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .diploma-5 {
            background-image: url('<?php echo e(asset("vendor/adminlte/dist/img/educacion.png")); ?>');
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
            color: #000;
        }

        .curso {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            color: #000;
        }

        .modalidad {
            position: absolute;
            top: 56%;
            left: 43%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #000;
        }

        .duracion {
            position: absolute;
            top: 56%;
            left: 73%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #000;
        }

        .fecha-finalizacion {
            position: absolute;
            top: 62%;
            left: 58%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #000;
        }

        .fecha-emision {
            position: absolute;
            top: 66%;
            left: 50%;
            font-size: 20px;
            color: #000;
        }

        .tutor {
            position: absolute;
            top: 81%;
            left: 65%;
            font-size: 20px;
            color: #000;
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
        }
    </style>
</head>
<body>

<div class="generator-container">
    <!-- Botón de modo oscuro -->
    <button id="botonModoOscuro" onclick="alternarModoOscuro()">
        <img src="<?php echo e(asset('vendor/adminlte/dist/img/day.png')); ?>" alt="Modo Claro" id="iconoTema">
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
    </div>

    <!-- Selector de diseño -->
    <div class="design-selector">
        <div class="design-option active" data-design="1">
            <img src="<?php echo e(asset('vendor/adminlte/dist/img/diploma.png')); ?>" class="design-preview">
            <div class="design-name">Diploma 1</div>
        </div>
        <div class="design-option" data-design="2">
            <img src="<?php echo e(asset('vendor/adminlte/dist/img/general2.png')); ?>" class="design-preview">
            <div class="design-name">Diploma 2</div>
        </div>
        <div class="design-option" data-design="3">
            <img src="<?php echo e(asset('vendor/adminlte/dist/img/juventud.png')); ?>" class="design-preview">
            <div class="design-name">Comité Juventud</div>
        </div>
        <div class="design-option" data-design="4">
            <img src="<?php echo e(asset('vendor/adminlte/dist/img/genero.png')); ?>" class="design-preview">
            <div class="design-name">Comité Género</div>
        </div>
        <div class="design-option" data-design="5">
            <img src="<?php echo e(asset('vendor/adminlte/dist/img/educacion.png')); ?>" class="design-preview">
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
        <img src="<?php echo e(asset('vendor/adminlte/dist/img/diploma.png')); ?>" id="diploma-preview" class="diploma-preview">
        <div style="margin-top: 10px; font-style: italic; color: #666;">Vista previa del diseño seleccionado</div>
    </div>

    <!-- Diplomas generados -->
    <div id="generated-diplomas" class="generated-diplomas">
        <h3 style="text-align: center; color: var(--primary); margin-bottom: 20px;">
            Diplomas Generados
        </h3>
        
        <div id="contenedor-diplomas"></div>
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
        }
    });

    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
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

            const indiceEncabezado = lineas.findIndex(linea => linea.startsWith('Nombre;Nota Final'));
            if (indiceEncabezado === -1) {
                alert("Error: El CSV no tiene la cabecera 'Nombre;Nota Final'");
                return;
            }

            estudiantes = [];
            for (let i = indiceEncabezado + 1; i < lineas.length; i++) {
                const celdas = lineas[i].split(';').map(c => c.trim());
                // Solo procesar si la línea tiene contenido en la primera celda y no es una fila vacía
                if (celdas[0] && celdas[0] !== '' && celdas[0] !== 'Nombre') {
                    estudiantes.push({
                        id: i,
                        nombreCompleto: celdas[0],
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
        const enlace = document.createElement('a');
        enlace.href = 'vendor/adminlte/dist/img/Plantilla_Diploma.csv';
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
        
        // Scroll a la sección de diplomas generados
        document.getElementById('generated-diplomas').scrollIntoView({ behavior: 'smooth' });
    }

    async function descargarDiploma(indice) {
        try {
            const elemento = document.getElementById(`diploma-${estudiantes[indice].id}`);
            const lienzo = await html2canvas(elemento, { 
                useCORS: true,
                scale: 2,
                logging: false,
                allowTaint: true
            });
            
            const enlace = document.createElement('a');
            enlace.download = `Diploma_${estudiantes[indice].nombreCompleto.replace(/ /g, '_')}.png`;
            enlace.href = lienzo.toDataURL('image/png');
            enlace.click();
        } catch (error) {
            console.error('Error al generar diploma:', error);
            alert("Error al generar el diploma");
        }
    }
    
    async function descargarTodos() {
        try {
            const archivoZip = new JSZip();
            const diplomas = await Promise.all(estudiantes.map(async (estudiante, indice) => {
                const elemento = document.getElementById(`diploma-${estudiante.id}`);
                const lienzo = await html2canvas(elemento, { 
                    useCORS: true,
                    scale: 2,
                    logging: false,
                    allowTaint: true
                });
                return {
                    nombre: `Diploma_${estudiante.nombreCompleto.replace(/ /g, '_')}.png`,
                    datos: lienzo.toDataURL('image/png')
                };
            });
            
            diplomas.forEach(diploma => {
                const datosBase64 = diploma.datos.split(',')[1];
                archivoZip.file(diploma.nombre, datosBase64, { base64: true });
            });

            const contenido = await archivoZip.generateAsync({ type: "blob" });
            const enlace = document.createElement('a');
            enlace.href = URL.createObjectURL(contenido);
            enlace.download = "Diplomas.zip";
            enlace.click();
        } catch (error) {
            console.error('Error al generar ZIP:', error);
            alert("Error al generar el archivo ZIP");
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
            document.getElementById('botonGenerar').disabled = false;
            estudiantes = [];
            document.getElementById('nombre-archivo').textContent = 'No se ha seleccionado archivo';
            document.getElementById('archivoCSV').value = '';
        }
    }
</script>
</body>
</html>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .sidebar {
            font-size: 14px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/generacion.blade.php ENDPATH**/ ?>