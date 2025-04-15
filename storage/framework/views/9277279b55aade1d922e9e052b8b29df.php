<?php $__env->startSection('title', 'Generador de diplomas'); ?>

<?php $__env->startSection('content_header'); ?>
<h1><center>Generador de Diplomas General 1</center></h1>
<div class="instrucciones">
    <p>En esta página puedes generar certificados de reconocimiento para participantes de cursos o talleres.</p>
    
    <p><span class="destacado">Instrucciones:</span></p>
    <ol>
        <li>Descarga la plantilla en formato CSV haciendo clic en el botón correspondiente.</li>
        <li><span class="destacado">No modifiques la estructura de la plantilla</span>, ya que es específica para que el sistema pueda leerla correctamente.</li>
        <li>Completa solo los campos solicitados en el archivo CSV con los datos necesarios.</li>
        <li>Sube el archivo completado utilizando el botón "Seleccionar archivo".</li>
        <li>Genera los certificados haciendo clic en el botón correspondiente.</li>
        <li>Puedes descargar los certificados individualmente o todos juntos en un archivo ZIP.</li>
        <li>Si deseas realizar un nuevo lote de certificados, haz clic en Refrescar para limpiar los anteriores.</li>
    </ol>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Profesores</title>
    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #333333;
            --button-bg: #285430;
            --button-hover: #112214;
            --panel-bg: #bdf1c6;
            --nombre-color: #2c3e50;
            --secondary-color: #285430;
            --tutor-color: #0d0e0d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding-bottom: 100px;
        }

        .instrucciones {
            background-color: #f9f9f9;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .destacado {
            font-weight: bold;
            color: #e74c3c;
        }

        .contenedor-imagen {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }
        
        .marco-imagen {
            border: 8px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            background-color: #f5f5f5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .marco-imagen:hover {
            border-color: #4CAF50;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }
        
        .imagen-interactiva {
            max-width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }
        
        .marco-imagen:hover .imagen-interactiva {
            transform: scale(1.05);
        }
        
        .pie-imagen {
            text-align: center;
            margin-top: 10px;
            font-style: italic;
            color: #666;
        }

        #botonDescargarTodos {
            display: none;
        }

        .diploma {
            background-image: url('vendor/adminlte/dist/img/diploma.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }

        .tipo-documento {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            color: var(--nombre-color);
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
        }

        .nombre {
            position: absolute;
            top: 47%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 45px;
            text-align: center;
            font-family: 'Vivaldi', sans-serif;
            color: var(--nombre-color);
        }

        .curso {
            position: absolute;
            top: 31%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 30px;
            text-align: center;
            color: var(--nombre-color);
        }

        .modalidad {
            position: absolute;
            top: 56%;
            left: 43%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            color: var(--secondary-color);
        }

        .duracion {
            position: absolute;
            top: 56%;
            left: 73%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            color: var(--secondary-color);
        }

        .fecha-finalizacion {
            position: absolute;
            top: 62%;
            left: 59%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            color: var(--secondary-color);
        }

        .fecha-emision {
            position: absolute;
            top: 66%;
            left: 50%;
            font-size: 25px;
            color: var(--secondary-color);
        }

        .tutor {
            position: absolute;
            top: 80%;
            left: 63%;
            font-size: 25px;
            color: var(--tutor-color);
        }

        .botones {
            margin: 20px;
            padding: 10px;
            background: var(--panel-bg);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .grupo-botones {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        button {
            padding: 10px 20px;
            background: var(--button-bg);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background: var(--button-hover);
        }

        #contenedor {
            margin-top: 20px;
        }

        .certificado-item {
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-descargar {
            padding: 10px 20px;
            background: var(--button-bg);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 15px 0;
            transition: background-color 0.3s;
        }
        
        .btn-descargar:hover {
            background: var(--button-hover);
        }

        /* Añadir estilo para el modal de carga */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        
        .progress-bar {
            width: 100%;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin: 15px 0;
        }
        
        .progress {
            height: 20px;
            background-color: #285430;
            border-radius: 5px;
            width: 0%;
            transition: width 0.3s;
        }

        @media (max-width: 768px) {
            .marco-imagen {
                max-width: 300px;
                padding: 3px;
            }
            
            .pie-imagen {
                font-size: 0.8em;
            }
            
            .botones {
                padding: 10px;
            }
            
            .grupo-botones {
                flex-direction: column;
            }
            
            .diploma {
                width: 100%;
                height: auto;
                aspect-ratio: 297/210;
            }
            
            .nombre {
                font-size: 24px;
            }
            
            .curso {
                font-size: 18px;
            }
            
            .modalidad, .duracion, .fecha-finalizacion, .fecha-emision, .tutor {
                font-size: 14px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</head>
<body>

<div class="contenedor-imagen">
    <div class="marco-imagen">
        <img src="vendor/adminlte/dist/img/diploma.png" alt="Imagen" class="imagen-interactiva" id="certificado-preview">
        <div class="pie-imagen">Vista previa del diseño</div>
    </div>
</div>

<div class="botones">
    <div class="grupo-botones">
        <button onclick="descargarPlantilla()">Descargar Plantilla</button> 
    </div>
    
    <div class="grupo-botones">
        <input type="file" id="archivoCSV" accept=".csv">
        <button onclick="generarDiplomas()" id="botonGenerar">Generar Diplomas</button>
        <button onclick="descargarTodos()" id="botonDescargarTodos">Descargar Todos (ZIP)</button>
        <button onclick="refrescarDiplomas()">Refrescar</button>
    </div>
</div>

<div id="contenedor"></div>

<script>
    let estudiantes = [];
    let metadatos = {
        curso: '',
        tutor: '',
        fechaFinalizacion: '',
        modalidad: '',
        duracion: ''
    };

    function descargarPlantilla() {
        const contenido = `Curso:;Nombre del curso
Tutor:;Nombre del tutor
Fecha de finalizacion:;DD/MM/AAAA
Modalidad:;Presencial/Virtual
Duracion:;X horas
Nombre;Nota Final
Nombre Apellido1 Apellido2;
Nombre Apellido1 Apellido2;`;

        const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(blob);
        enlace.download = 'Plantilla_Diploma.csv';
        enlace.click();
    }

    document.getElementById('archivoCSV').addEventListener('change', function(evento) {
        const archivo = evento.target.files[0];
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Extraer metadatos
            lineas.forEach(linea => {
                const celdas = linea.split(';').map(c => c.trim());
                if (celdas[0] === 'Curso:') metadatos.curso = celdas[1] || 'No especificado';
                if (celdas[0] === 'Tutor:') metadatos.tutor = celdas[1] || 'No especificado';
                if (celdas[0] === 'Fecha de finalizacion:') metadatos.fechaFinalizacion = celdas[1] || 'No especificada';
                if (celdas[0] === 'Modalidad:') metadatos.modalidad = celdas[1] || 'No especificada';
                if (celdas[0] === 'Duracion:') metadatos.duracion = celdas[1] || 'No especificada';
            });

            // Buscar inicio de la lista de estudiantes
            estudiantes = [];
            for (let i = 0; i < lineas.length; i++) {
                if (lineas[i] && !lineas[i].includes('Nombre del participante') && 
                    !lineas[i].includes('Nota Final') &&
                    !lineas[i].includes('INSTRUCCIONES') &&
                    !lineas[i].includes('Curso:') &&
                    !lineas[i].includes('Tutor:') &&
                    !lineas[i].includes('Fecha de finalizacion:') &&
                    !lineas[i].includes('Modalidad:') &&
                    !lineas[i].includes('Duracion:')) {
                    
                    const nombre = lineas[i].split(';')[0].trim();
                    if (nombre) {
                        estudiantes.push({
                            nombreCompleto: nombre,
                            ...metadatos,
                            fechaEmision: new Date().toLocaleDateString('es-ES', { 
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            })
                        });
                    }
                }
            }
            
            if (estudiantes.length > 0) {
                document.getElementById('botonGenerar').disabled = false;
                alert(`Se han cargado ${estudiantes.length} participantes correctamente`);
            } else {
                alert("No se encontraron participantes válidos en el archivo");
                document.getElementById('botonGenerar').disabled = true;
            }
        };
        
        lector.onerror = function() {
            alert("Error al leer el archivo");
            document.getElementById('botonGenerar').disabled = true;
        };
        
        lector.readAsArrayBuffer(archivo);
    });

    function generarDiplomas() {
        const contenedor = document.getElementById('contenedor');
        contenedor.innerHTML = '';
        
        estudiantes.forEach((estudiante, indice) => {
            contenedor.innerHTML += `
                <div class="certificado-item">
                    <div class="diploma" id="diploma-${indice}">
                        <div class="nombre">${estudiante.nombreCompleto}</div>
                        <div class="curso">${estudiante.curso}</div>
                        <div class="modalidad">${estudiante.modalidad}</div>
                        <div class="duracion">${estudiante.duracion}</div>
                        <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                        <div class="fecha-emision">${estudiante.fechaEmision}</div>
                        <div class="tutor">${estudiante.tutor}</div>
                    </div>
                    <button onclick="descargarDiploma(${indice})" class="btn-descargar">Descargar Diploma ${indice + 1}</button>
                </div>
            `;
        });
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('botonGenerar').disabled = true;
    }

    async function descargarDiploma(indice) {
        try {
            const elemento = document.getElementById(`diploma-${indice}`);
            const lienzo = await html2canvas(elemento, { 
                useCORS: true, 
                scale: 2,
                backgroundColor: null
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
            // Crear overlay de carga
            const overlay = document.createElement('div');
            overlay.className = 'loading-overlay';
            overlay.innerHTML = `
                <div class="loading-content">
                    <h3>Generando archivo ZIP</h3>
                    <p>Por favor espere, esto puede tomar varios minutos...</p>
                    <div class="progress-bar">
                        <div class="progress" id="zip-progress"></div>
                    </div>
                    <p id="progress-text">0/${estudiantes.length} diplomas procesados</p>
                </div>
            `;
            document.body.appendChild(overlay);
            
            const botonDescargar = document.getElementById('botonDescargarTodos');
            botonDescargar.disabled = true;
            botonDescargar.textContent = 'Generando...';
            
            const archivoZip = new JSZip();
            const folder = archivoZip.folder("Diplomas");
            const progressBar = document.getElementById('zip-progress');
            const progressText = document.getElementById('progress-text');
            
            // Procesar en lotes de 3 para mejor rendimiento
            const batchSize = 3;
            let processed = 0;
            
            for (let i = 0; i < estudiantes.length; i += batchSize) {
                const batch = estudiantes.slice(i, i + batchSize);
                const batchPromises = batch.map(async (estudiante, batchIndex) => {
                    const indice = i + batchIndex;
                    const elemento = document.getElementById(`diploma-${indice}`);
                    
                    const lienzo = await html2canvas(elemento, { 
                        useCORS: true, 
                        scale: 1.5,
                        backgroundColor: null,
                        logging: false
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
            
            // Limpiar
            document.body.removeChild(overlay);
            botonDescargar.disabled = false;
            botonDescargar.textContent = 'Descargar Todos (ZIP)';
            
        } catch (error) {
            console.error('Error al generar ZIP:', error);
            alert("Error al generar el archivo ZIP. Por favor intente con menos diplomas o recargue la página.");
            
            // Limpiar en caso de error
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) document.body.removeChild(overlay);
            
            const botonDescargar = document.getElementById('botonDescargarTodos');
            if (botonDescargar) {
                botonDescargar.disabled = false;
                botonDescargar.textContent = 'Descargar Todos (ZIP)';
            }
        }
    }

    function refrescarDiplomas() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los diplomas generados?")) {
            document.getElementById('contenedor').innerHTML = '';
            document.getElementById('botonDescargarTodos').style.display = 'none';
            document.getElementById('botonGenerar').disabled = false;
            estudiantes = [];
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/generador.blade.php ENDPATH**/ ?>