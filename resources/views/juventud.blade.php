@extends('adminlte::page')

@section('title', 'Generador de diplomas')

@section('content_header')
<h1><center>Generador de Diplomas para Comité de Juventud</h1>
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
@stop


@section('content')


<!DOCTYPE html>
<html>
<head>
    <title>Profesores</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</head>
<body>
<div class="contenedor-imagen">
        <div class="marco-imagen">
            <img src="vendor/adminlte/dist/img/juventud.png" alt="Imagen" class="imagen-interactiva">
            <div class="pie-imagen">Vista previa de Comite de Genero</div>
        </div>
<div class="botones">
    <div>
        <button onclick="descargarPlantilla()">Descargar Plantilla</button> 
    </div>
    <div>
        <input type="file" id="archivoCSV" accept=".csv">
        <button onclick="generarDiplomas()" id="botonGenerar">Generar Diplomas</button>
        <button onclick="descargarTodos()" id="botonDescargarTodos">Descargar Todos (ZIP)</button>
        <div id="contenedor"></div>
    </div> 
</div>
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
        const enlace = document.createElement('a');
        enlace.href = 'vendor/adminlte/dist/img/Plantilla_Diploma.csv';
        
        enlace.download = 'Plantilla_Diploma.csv';
        enlace.click();
    }

    document.getElementById('archivoCSV').addEventListener('change', function(evento) {
        const archivo = evento.target.files[0];
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
    });

    function generarDiplomas() {
        const contenedor = document.getElementById('contenedor');
        contenedor.innerHTML = '';
        estudiantes.forEach((estudiante, indice) => {
            contenedor.innerHTML += `
                <div class="diploma" id="diploma-${indice}">
                    <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                    <div class="curso"><u>${estudiante.curso}</u></div>
                    <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                    <div class="duracion"><u>${estudiante.duracion}</u></div>
                    <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                    <div class="fecha-emision">${estudiante.fechaEmision}</div>
                    <div class="tutor">${estudiante.tutor}</div>
                </div>
                <button onclick="descargarDiploma(${indice})">Descargar Individual</button>
            `;
        });
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('botonGenerar').disabled = true;
    }

    async function descargarDiploma(indice) {
        try {
            const elemento = document.getElementById(`diploma-${indice}`);
            const lienzo = await html2canvas(elemento, { useCORS: true, scale: 2 });
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
                const elemento = document.getElementById(`diploma-${indice}`);
                const lienzo = await html2canvas(elemento, { useCORS: true, scale: 2 });
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
</script>
</body>
</html>
@stop

@section('css')
    <style>

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
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .diploma {
        background-image: url('vendor/adminlte/dist/img/juventud.png');
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
        margin: 5px;
        transition: background-color 0.3s;
    }

    button:hover {
        background: var(--button-hover);
    }

        .sidebar {
            font-size: 14px; /* Ajusta el tamaño de la fuente */
        }
    </style>
@endsection
