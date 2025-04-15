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
            --nombre-color: #000;
            --secondary-color: #285430;
            --tutor-color: #0d0e0d;
            --diploma-bg: url('vendor/adminlte/dist/img/general2.png');
        }

        .dark-mode {
            --bg-color: #ffffff;
            --text-color: #333333;
            --button-bg: #285430;
            --button-hover: #112214;
            --panel-bg:rgb(20, 29, 22);
            --nombre-color: #000;
            --secondary-color: #285430;
            --tutor-color: #0d0e0d;
            --diploma-bg: url('vendor/adminlte/dist/img/general2.png');
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            padding-bottom: 100px;
            transition: background-color 0.5s, color 0.5s;
        }

        .instrucciones {
            background-color: var(--panel-bg);
            border-left: 4px solid var(--button-bg);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            transition: all 0.5s;
        }
        
        .destacado {
            font-weight: bold;
            color: var(--secondary-color);
        }

        .contenedor-imagen {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }
        
        .marco-imagen {
            border: 8px solid var(--panel-bg);
            border-radius: 10px;
            padding: 10px;
            background-color: var(--panel-bg);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .marco-imagen:hover {
            border-color: var(--button-bg);
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
            color: var(--text-color);
        }

        #botonDescargarTodos {
            display: none;
        }

        .diploma {
            background-image: var(--diploma-bg);
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
            transition: all 0.5s;
        }

        .grupo-botones {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input[type="file"] {
            margin: 10px 0;
            background: var(--bg-color);
            color: var(--text-color);
            padding: 8px;
            border-radius: 5px;
            border: 1px solid var(--button-bg);
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
            background: var(--panel-bg);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            color: var(--text-color);
        }
        
        .progress-bar {
            width: 100%;
            background-color: var(--bg-color);
            border-radius: 5px;
            margin: 15px 0;
        }
        
        .progress {
            height: 20px;
            background-color: var(--button-bg);
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

<!-- Botón de modo oscuro -->
<button id="botonModoOscuro" onclick="alternarModoOscuro()" style="position: fixed; top: 20px; right: 20px; z-index: 1000; background: transparent; border: none;">
    <img src="<?php echo e(asset('vendor/adminlte/dist/img/day.png')); ?>" alt="Modo Claro" id="iconoTema" width="40" height="40" style="transition: transform 0.5s;">
</button>

<div class="contenedor-imagen">
    <div class="marco-imagen">
        <img src="vendor/adminlte/dist/img/general2.png" alt="Imagen" class="imagen-interactiva" id="certificado-preview">
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
        cooperativa: 'Cooperativa de Ahorro y Crédito Talanga LTDA',
        curso: '',
        tutor: '',
        modalidad: '',
        duracion: '',
        fechaFinalizacion: ''
    };

    // Función para alternar modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "<?php echo e(asset('vendor/adminlte/dist/img/night.png')); ?>";
            icono.style.transform = 'rotate(360deg)';
            // Cambiar imagen de vista previa
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/general2.png";
        } else {
            icono.src = "<?php echo e(asset('vendor/adminlte/dist/img/day.png')); ?>";
            icono.style.transform = 'rotate(0deg)';
            // Cambiar imagen de vista previa
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/general2.png";
        }
    }

    // Verificar modo oscuro al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "<?php echo e(asset('vendor/adminlte/dist/img/night.png')); ?>";
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/general2.png";
        }
    });

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

    document.getElementById('archivoCSV').addEventListener('change', function(evento) {
        const archivo = evento.target.files[0];
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Extraer metadatos
            for (let i = 0; i < lineas.length; i++) {
                const linea = lineas[i];
                if (linea.startsWith('Curso:')) {
                    metadatos.curso = linea.split(';')[1] || '';
                } else if (linea.startsWith('Tutor:')) {
                    metadatos.tutor = linea.split(';')[1] || '';
                } else if (linea.startsWith('Tipo Documento:')) {
                    metadatos.tipoDocumento = linea.split(';')[1] || '';
                } else if (linea.startsWith('Modalidad:')) {
                    metadatos.modalidad = linea.split(';')[1] || '';
                } else if (linea.startsWith('Duracion:')) {
                    metadatos.duracion = linea.split(';')[1] || '';
                } else if (linea.startsWith('Fecha de finalizacion:')) {
                    metadatos.fechaFinalizacion = linea.split(';')[1] || '';
                }
            }

            // Buscar inicio de la lista de estudiantes
            estudiantes = [];
            let encontroEncabezado = false;
            let finDeLista = false;
            
            for (let i = 0; i < lineas.length && !finDeLista; i++) {
                const linea = lineas[i];
                
                // Buscar el encabezado de la lista de estudiantes
                if (linea.includes('Nombre;Nota Final')) {
                    encontroEncabezado = true;
                    continue;
                }
                
                // Si encontramos el encabezado, procesar estudiantes
                if (encontroEncabezado) {
                    const celdas = linea.split(';');
                    const nombre = celdas[0]?.trim();
                    
                    // Detener si encontramos una línea vacía o con ===
                    if (linea === '' || linea.startsWith('===') || linea.startsWith(';;')) {
                        finDeLista = true;
                        continue;
                    }
                    
                    // Solo procesar si hay un nombre válido (no vacío y no solo espacios o caracteres especiales)
                    if (nombre && nombre.length > 0 && !/^[;=\s]+$/.test(nombre)) {
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\CertificadosCoopTal\resources\views/general.blade.php ENDPATH**/ ?>