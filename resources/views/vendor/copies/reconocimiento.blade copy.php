@extends('adminlte::page')

@section('title', 'Generador de Certificados')

@section('content_header')
<h1><center>Generador de Certificados de Reconocimiento</center></h1>
<div class="instrucciones">
    <p>En esta página puedes generar certificados de reconocimiento para participantes de cursos o talleres.</p>
    
    <p><span class="destacado">Instrucciones:</span></p>
    <ol>
        <li>Descarga la plantilla en formato CSV haciendo clic en el botón correspondiente</li>
        <li><span class="destacado">No modifiques la estructura de la plantilla</span>, ya que es específica para que el sistema pueda leerla correctamente</li>
        <li>Completa solo los campos solicitados en el archivo CSV con los datos necesarios</li>
        <li>Sube el archivo completado utilizando el botón "Seleccionar archivo"</li>
        <li>Genera los certificados haciendo clic en el botón correspondiente</li>
        <li>Puedes descargar los certificados individualmente o todos juntos en un archivo ZIP</li>
        <li>Si deseas realizar un nuevo lote de certificados, haz clic en Refrescar para limpiar los anteriores</li>
    </ol>
</div>
@stop

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Generador de Certificados</title>
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
            --certificado-bg: url('vendor/adminlte/dist/img/reconocimiento.png');
            --border-color: #ddd;
            --highlight-color: #e74c3c;
            --progress-bg: #285430;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #000;
            --button-bg: #4a8c2a;
            --button-hover: #2c5e1a;
            --panel-bg:rgb(20, 29, 22);
            --nombre-color: #000;
            --secondary-color: #f8c537;
            --tutor-color: #000;
            --certificado-bg: url('vendor/adminlte/dist/img/reconocimiento.png');
            --border-color: #444;
            --highlight-color: #f8c537;
            --progress-bg: #f8c537;
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
            color: var(--highlight-color);
        }

        .contenedor-imagen {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }
        
        .marco-imagen {
            border: 8px solid var(--border-color);
            border-radius: 10px;
            padding: 5px;
            background-color: var(--panel-bg);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .marco-imagen:hover {
            border-color: var(--button-bg);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.01);
        }
        
        .imagen-interactiva {
            max-width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }
        
        .marco-imagen:hover .imagen-interactiva {
            transform: scale(1.02);
        }
        
        .pie-imagen {
            text-align: center;
            margin-top: 5px;
            font-style: italic;
            color: var(--text-color);
            font-size: 0.9em;
            opacity: 0.8;
        }

        #botonDescargarTodos {
            display: none;
        }

        .certificado {
            background-image: var(--certificado-bg);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
        }
        
        .nombre-certificado {
            position: absolute;
            top: 47%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            text-align: center;
            font-family: 'Vivaldi', sans-serif;
            color: var(--nombre-color);
        }

        .texto-certificado {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            font-size: 20px;
            text-align: center;
            color: var(--text-color);
        }
        
        .fecha-certificado {
            position: absolute;
            top: 95%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
            color: var(--text-color);
        }

        /* Estilos para el QR */
        .qr-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            background-color: white;
            padding: 5px;
            border: 1px solid var(--border-color);
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
            transition: all 0.3s;
        }

        button:hover {
            background: var(--button-hover);
            transform: translateY(-2px);
        }

        button:disabled {
            background: #cccccc;
            cursor: not-allowed;
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
            transition: all 0.3s;
        }
        
        .btn-descargar:hover {
            background: var(--button-hover);
            transform: translateY(-2px);
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
        
        .progress-bar {
            width: 100%;
            background-color: var(--bg-color);
            border-radius: 5px;
            margin: 15px 0;
            overflow: hidden;
        }
        
        .progress {
            height: 20px;
            background-color: var(--progress-bg);
            border-radius: 5px;
            width: 0%;
            transition: width 0.3s;
        }

        /* Botón de modo oscuro */
        #botonModoOscuro {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        #iconoTema {
            width: 40px;
            height: 40px;
            transition: transform 0.5s, filter 0.3s;
        }

        #iconoTema:hover {
            filter: brightness(1.2);
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
            
            .certificado {
                width: 100%;
                height: auto;
                aspect-ratio: 297/210;
            }
            
            .nombre-certificado {
                font-size: 24px;
                top: 35%;
            }
            
            .texto-certificado {
                font-size: 14px;
                top: 50%;
                width: 80%;
            }
            
            .fecha-certificado {
                top: 85%;
            }

            .qr-container {
                width: 60px;
                height: 60px;
                bottom: 10px;
                right: 10px;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Añadimos la librería QR -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
</head>
<body>

<!-- Botón de modo oscuro -->
<button id="botonModoOscuro" onclick="alternarModoOscuro()">
    <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema" width="40" height="40">
</button>

<div class="contenedor-imagen">
    <div class="marco-imagen">
        <img src="vendor/adminlte/dist/img/reconocimiento.png" alt="Imagen" class="imagen-interactiva" id="certificado-preview">
        <div class="pie-imagen">Vista previa del diseño</div>
    </div>
</div>

<div class="botones">
    <div class="grupo-botones">
        <button onclick="descargarPlantilla()">Descargar Plantilla</button> 
    </div>
    
    <div class="grupo-botones">
        <input type="file" id="archivoCSV" accept=".csv">
        <button onclick="generarCertificados()" id="botonGenerar">Generar Certificados</button>
        <button onclick="descargarTodos()" id="botonDescargarTodos">Descargar Todos (ZIP)</button>
        <button onclick="refrescarCertificados()">Refrescar</button>
    </div>
</div>

<div id="contenedor"></div>

<script>
    let participantes = [];
    let datosCurso = {
        cooperativa: 'Cooperativa de Ahorro y Crédito Talanga LTDA',
        tutor: '',
        texto: '',
        urlValidacion: 'https://www.cooptalanga.com/validar-certificado' // URL para la validación
    };

    // Función para alternar modo oscuro
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        const icono = document.getElementById('iconoTema');
        if (modoOscuroActivado) {
            icono.src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            icono.style.transform = 'rotate(360deg)';
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/reconocimiento.png";
        } else {
            icono.src = "{{ asset('vendor/adminlte/dist/img/day.png') }}";
            icono.style.transform = 'rotate(0deg)';
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/reconocimiento.png";
        }
    }

    // Verificar modo oscuro al cargar
    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('modoOscuro') === 'true') {
            document.body.classList.add('dark-mode');
            document.getElementById('iconoTema').src = "{{ asset('vendor/adminlte/dist/img/night.png') }}";
            document.getElementById('certificado-preview').src = "vendor/adminlte/dist/img/reconocimiento.png";
        }
    });

    function descargarPlantilla() {
        const contenido = `Cooperativa de Ahorro y Crédito Talanga LTDA

INSTRUCCIONES:
1. Complete los datos del tutor abajo
2. Escriba el texto a escribir en el certificado
3. Escriba el nombre del participante a certificar en lista hacia abajo
4. No use tildes ni modifique la estructura
5. Guarde el archivo como CSV (delimitado por punto y coma)

Tutor:
Texto a escribir en diploma:
Nazareth Del Carmen Caceres Hernandez
Glenda Sagrario Hernandez Rodriguez Caceres Jaqueline`;

        const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(blob);
        enlace.download = 'Plantilla_Certificado.csv';
        enlace.click();
    }

    document.getElementById('archivoCSV').addEventListener('change', function(evento) {
        const archivo = evento.target.files[0];
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Extraer tutor y texto
            for (let i = 0; i < lineas.length; i++) {
                if (lineas[i].startsWith('Tutor:')) {
                    datosCurso.tutor = lineas[i].split(';')[0].replace('Tutor:', '').trim();
                }
                if (lineas[i].startsWith('Texto a escribir en diploma:')) {
                    datosCurso.texto = lineas[i].split('"')[1] || lineas[i].split(':')[1]?.trim() || '';
                }
            }

            // Buscar inicio de la lista de participantes
            participantes = [];
            for (let i = 0; i < lineas.length; i++) {
                if (lineas[i] && !lineas[i].includes('Nombre del participante') && 
                    !lineas[i].includes('Texto a escribir en diploma') &&
                    !lineas[i].includes('INSTRUCCIONES') &&
                    !lineas[i].includes('Cooperativa') &&
                    !lineas[i].includes('Tutor:')) {
                    
                    const nombre = lineas[i].split(';')[0].trim();
                    if (nombre) {
                        participantes.push({
                            nombre: nombre,
                            codigo: generarCodigoUnico()
                        });
                    }
                }
            }
            
            if (participantes.length > 0) {
                document.getElementById('botonGenerar').disabled = false;
                alert(`Se han cargado ${participantes.length} participantes correctamente`);
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

    // Función para generar un código único para cada certificado
    function generarCodigoUnico() {
        return 'CT-' + Math.random().toString(36).substr(2, 9).toUpperCase();
    }

    // Función para generar el código QR
    function generarQR(texto, elementoContenedor) {
        const qr = qrcode(0, 'L');
        qr.addData(texto);
        qr.make();
        elementoContenedor.innerHTML = qr.createImgTag(4);
        const img = elementoContenedor.querySelector('img');
        img.style.width = '100%';
        img.style.height = '100%';
    }

    function generarCertificados() {
        const contenedor = document.getElementById('contenedor');
        contenedor.innerHTML = '';
        
        participantes.forEach((participante, indice) => {
            const certificadoId = `certificado-${indice}`;
            contenedor.innerHTML += `
                <div class="certificado-item">
                    <div class="certificado" id="${certificadoId}">
                        <div class="nombre-certificado">${participante.nombre}</div>
                        <div class="texto-certificado">${datosCurso.texto || 'Por su participación y dedicación demostrada'}</div>
                        <div class="fecha-certificado">${new Date().toLocaleDateString('es-ES')}</div>
                        <div class="qr-container" id="qr-${indice}"></div>
                    </div>
                    <button onclick="descargarCertificado(${indice})" class="btn-descargar">Descargar Certificado ${indice + 1}</button>
                </div>
            `;
            
            // Generar QR después de que se haya creado el elemento en el DOM
            setTimeout(() => {
                const qrContainer = document.getElementById(`qr-${indice}`);
                const urlValidacion = `${datosCurso.urlValidacion}?codigo=${participante.codigo}&nombre=${encodeURIComponent(participante.nombre)}`;
                generarQR(urlValidacion, qrContainer);
            }, 100);
        });
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('botonGenerar').disabled = true;
    }

    async function descargarCertificado(indice) {
        try {
            const elemento = document.getElementById(`certificado-${indice}`);
            const lienzo = await html2canvas(elemento, { 
                useCORS: true, 
                scale: 2,
                backgroundColor: null
            });
            const enlace = document.createElement('a');
            enlace.download = `Certificado_${participantes[indice].nombre.replace(/ /g, '_')}.png`;
            enlace.href = lienzo.toDataURL('image/png');
            enlace.click();
        } catch (error) {
            console.error('Error al generar certificado:', error);
            alert("Error al generar el certificado");
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
                    <p id="progress-text">0/${participantes.length} certificados procesados</p>
                </div>
            `;
            document.body.appendChild(overlay);
            
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

    function refrescarCertificados() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los certificados generados?")) {
            document.getElementById('contenedor').innerHTML = '';
            document.getElementById('botonDescargarTodos').style.display = 'none';
            document.getElementById('botonGenerar').disabled = false;
            participantes = [];
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