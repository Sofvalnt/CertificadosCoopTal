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
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        .generator-container {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .design-selector {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            position: sticky;
            top: 20px;
            background: white;
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
            display: none;
            margin-top: 40px;
        }

        .diploma-item {
            margin-bottom: 30px;
            text-align: center;
        }

        .diploma-controls {
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

        @media (max-width: 768px) {
            .design-option {
                width: 150px;
            }
            .control-group {
                flex-direction: column;
                align-items: flex-start;
            }
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
            background-color: #3a7a24;
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

        /* Contenedor de generación dinámico */
        .generation-container {
            transition: all 0.3s ease;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="generator-container">
    <h2 style="text-align: center; color: var(--primary); margin-bottom: 30px;">
        <i class="fas fa-certificate"></i> Generador de Diplomas
    </h2>

    <!-- Selector de diseño (ahora sticky) -->
    <div class="design-selector">
        <div class="design-option active" data-design="diploma">
            <img src="{{ asset('vendor/adminlte/dist/img/diploma.png') }}" class="design-preview">
            <div class="design-name">Diploma 1</div>
        </div>
        <div class="design-option" data-design="diploma2">
            <img src="{{ asset('vendor/adminlte/dist/img/general2.png') }}" class="design-preview">
            <div class="design-name">Diploma 2</div>
        </div>
        <div class="design-option" data-design="juventud">
            <img src="{{ asset('vendor/adminlte/dist/img/juventud.png') }}" class="design-preview">
            <div class="design-name">Comité de Juventud</div>
        </div>
        <div class="design-option" data-design="genero">
            <img src="{{ asset('vendor/adminlte/dist/img/genero.png') }}" class="design-preview">
            <div class="design-name">Comité de Género</div>
        </div>
        <div class="design-option" data-design="educacion">
            <img src="{{ asset('vendor/adminlte/dist/img/educacion.png') }}" class="design-preview">
            <div class="design-name">Comité de Educación</div>
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
        <div style="margin-top: 10px; font-style: italic; color: #666;">Vista previa del diseño seleccionado</div>
    </div>

    <!-- Contenedor de generación dinámico -->
    <div id="generation-container" class="generation-container" style="display: none;">
        <!-- El contenido se cargará dinámicamente según el diseño seleccionado -->
    </div>

    <!-- Diplomas generados -->
    <div id="generated-diplomas" class="generated-diplomas">
        <h3 style="text-align: center; color: var(--primary); margin-bottom: 20px;">
            Diplomas Generados
        </h3>
        
        <!-- Controles para diplomas generados -->
        <div class="diploma-controls">
            <button onclick="refrescarDiplomas()" class="btn btn-info">
                <i class="fas fa-sync-alt"></i> Refrescar Diplomas
            </button>
            <button onclick="eliminarDiplomas()" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Eliminar Todos
            </button>
        </div>
        
        <div id="contenedor-diplomas"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
    // Variables globales
    let estudiantes = [];
    let metadatos = {
        curso: '',
        tutor: '',
        fechaFinalizacion: '',
        modalidad: '',
        duracion: ''
    };
    let diseñoActual = 'diploma';
    const imagenesDisenos = {
        diploma: 'vendor/adminlte/dist/img/diploma.png',
        diploma2: 'vendor/adminlte/dist/img/general2.png',
        juventud: 'vendor/adminlte/dist/img/juventud.png',
        genero: 'vendor/adminlte/dist/img/genero.png',
        educacion: 'vendor/adminlte/dist/img/educacion.png'
    };

    // Plantillas de generación para cada diseño
    const plantillasGeneracion = {
        diploma: `
            <div style="width: 100%; max-width: 600px; margin: 0 auto; position: relative;">
                <img src="{{ asset('vendor/adminlte/dist/img/diploma.png') }}" style="width: 100%;">
                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 80%; text-align: center;">
                    <div style="font-size: 28px; font-family: 'Times New Roman', serif; color: #2c3e50;">
                        <u>[[NOMBRE]]</u>
                    </div>
                </div>
            </div>
        `,
        diploma2: `
            <div style="width: 100%; max-width: 600px; margin: 0 auto; position: relative;">
                <img src="{{ asset('vendor/adminlte/dist/img/general2.png') }}" style="width: 100%;">
                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 80%; text-align: center;">
                    <div style="font-size: 24px; font-family: Arial, sans-serif; color: #1a5276; font-weight: bold;">
                        [[NOMBRE]]
                    </div>
                </div>
            </div>
        `,
        juventud: `
            <div style="width: 100%; max-width: 600px; margin: 0 auto; position: relative;">
                <img src="{{ asset('vendor/adminlte/dist/img/juventud.png') }}" style="width: 100%;">
                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 80%; text-align: center;">
                    <div style="font-size: 26px; font-family: 'Times New Roman', serif; color: #5d4037; font-style: italic;">
                        [[NOMBRE]]
                    </div>
                </div>
            </div>
        `,
        genero: `
            <div style="width: 100%; max-width: 600px; margin: 0 auto; position: relative;">
                <img src="{{ asset('vendor/adminlte/dist/img/genero.png') }}" style="width: 100%;">
                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 80%; text-align: center;">
                    <div style="font-size: 24px; font-family: Arial, sans-serif; color: #1a5276; font-weight: bold;">
                        [[NOMBRE]]
                    </div>
                </div>
            </div>
        `,
        educacion: `
            <div style="width: 100%; max-width: 600px; margin: 0 auto; position: relative;">
                <img src="{{ asset('vendor/adminlte/dist/img/educacion.png') }}" style="width: 100%;">
                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 80%; text-align: center;">
                    <div style="font-size: 24px; font-family: Arial, sans-serif; color: #1a5276; font-weight: bold;">
                        [[NOMBRE]]
                    </div>
                </div>
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
                
                // Actualizar el contenedor de generación
                actualizarContenedorGeneracion();
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
    });

    function actualizarContenedorGeneracion() {
        const contenedor = document.getElementById('generation-container');
        contenedor.innerHTML = plantillasGeneracion[diseñoActual];
        contenedor.style.display = 'block';
    }

    function procesarArchivoCSV(archivo) {
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            lineas.forEach(linea => {
                const celdas = linea.split(';').map(c => c.trim());
                if (celdas[0] === 'Curso:') metadatos.curso = celdas[1] || 'No especificado';
                if (celdas[0] === 'Tutor:') metadatos.tutor = celdas[1] || 'No especificado';
                if (celdas[0] === 'Fecha de finalizacion:') metadatos.fechaFinalizacion = celdas[1] || 'No especificada';
                if (celdas[0] === 'Modalidad:') metadatos.modalidad = celdas[1] || 'No especificada';
                if (celdas[0] === 'Duracion:') metadatos.duracion = celdas[1] || 'No especificada';
            });

            const indiceEncabezado = lineas.findIndex(linea => linea.startsWith('Nombre;Nota Final'));
            if (indiceEncabezado === -1) return alert("Error: El CSV no tiene la cabecera 'Nombre;Nota Final'");

            estudiantes = [];
            for (let i = indiceEncabezado + 1; i < lineas.length; i++) {
                const celdas = lineas[i].split(';').map(c => c.trim());
                if (celdas[0]) {
                    estudiantes.push({
                        nombreCompleto: celdas[0],
                        ...metadatos,
                        fechaEmision: new Date().toLocaleDateString('es-ES', { 
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        })
                    });
                }
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
        
        estudiantes.forEach((estudiante, indice) => {
            let diplomaHTML = `
                <div class="diploma-item fade-in" style="animation-delay: ${indice * 0.1}s">
                    ${plantillasGeneracion[diseñoActual].replace('[[NOMBRE]]', estudiante.nombreCompleto)}
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
            const elemento = document.querySelectorAll('.diploma-item')[indice].querySelector('div');
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
                const elemento = document.querySelectorAll('.diploma-item')[indice].querySelector('div');
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
            }));
            
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
            alert("Diplomas refrescados correctamente");
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
            
            // Opcional: Scroll hacia arriba para ver el formulario
            window.scrollTo({ top: 0, behavior: 'smooth' });
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