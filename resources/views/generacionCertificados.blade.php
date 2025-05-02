@extends('adminlte::page')

@section('title', 'Generador de certificados')

@section('content')
<div class="container-fluid">
    <!-- Botón de modo oscuro -->
    <button id="botonModoOscuro">
        <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema">
    </button>

    <div class="generator-container">
        <h2><center><i class="fas fa-certificate"></i> Generador de Certificados</center></h2>

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
                <button id="descargarPlantillaBtn" class="btn btn-secondary">
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
                <button id="botonGenerar" class="btn" disabled>
                    <i class="fas fa-magic"></i> Generar Certificados
                </button>
                <button id="botonDescargarTodos" class="btn" style="display: none;">
                    <i class="fas fa-file-archive"></i> Descargar Todos (ZIP)
                </button>
            </div>
        </div>

        <!-- Vista previa del certificado -->
        <div class="certificado-preview-container">
            <img src="{{ asset('vendor/adminlte/dist/img/participacion.png') }}" id="certificado-preview" class="certificado-preview">
            <div class="preview-label">Vista previa del diseño seleccionado</div>
        </div>

        <!-- Certificados generados -->
        <div id="generated-certificates" class="generated-certificates">
            <h3>Certificados Generados</h3>
            
            <div class="certificado-controls">
                <button id="refrescarBtn" class="btn btn-info">
                    <i class="fas fa-sync-alt"></i> Refrescar Certificados
                </button>
                <button id="eliminarBtn" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i> Eliminar Todos
                </button>
            </div>
            
            <div id="contenedor-certificados"></div>
        </div>
    </div>

    <div class="fixed-buttons">
        <button id="refrescarBtnFixed" class="btn btn-info">
            <i class="fas fa-sync-alt"></i> Refrescar Certificados
        </button>
        <button id="eliminarBtnFixed" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Eliminar Todos
        </button>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/certificados.css') }}">
    <style>
        .sidebar {
            font-size: 14px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const archivoCSV = document.getElementById("archivoCSV");
        const nombreArchivo = document.getElementById("nombre-archivo");
        const botonGenerar = document.getElementById("botonGenerar");
        const botonDescargarTodos = document.getElementById("botonDescargarTodos");
        const contenedorCertificados = document.getElementById("contenedor-certificados");

        archivoCSV.addEventListener("change", function () {
            if (archivoCSV.files.length > 0) {
                nombreArchivo.textContent = archivoCSV.files[0].name;
                botonGenerar.disabled = false;
            }
        });

        botonGenerar.addEventListener("click", async function () {
            const certificados = document.querySelectorAll(".certificado-individual");

            if (certificados.length === 0) {
                alert("No hay certificados para generar.");
                return;
            }

            botonGenerar.disabled = true;
            botonGenerar.textContent = "Generando ZIP...";

            await generarZIP(Array.from(certificados));

            botonGenerar.disabled = false;
            botonGenerar.textContent = "Generar Certificados";
            botonDescargarTodos.style.display = "inline-block";
        });

        async function generarZIP(certificadosDOM) {
            const zip = new JSZip();
            const folder = zip.folder("certificados");

            const chunkSize = 10;
            for (let i = 0; i < certificadosDOM.length; i += chunkSize) {
                const chunk = certificadosDOM.slice(i, i + chunkSize);
                await Promise.all(chunk.map(async (certDOM, index) => {
                    const canvas = await html2canvas(certDOM, {
                        scale: 1,
                        useCORS: true,
                    });

                    return new Promise(resolve => {
                        canvas.toBlob(blob => {
                            const nombreArchivo = `certificado_${i + index + 1}.png`;
                            folder.file(nombreArchivo, blob);
                            resolve();
                        });
                    });
                }));
            }

            zip.generateAsync({ type: "blob" })
                .then(content => {
                    saveAs(content, "certificados.zip");
                })
                .catch(error => {
                    alert("Error al generar el archivo ZIP: " + error.message);
                });
        }

        botonDescargarTodos.addEventListener("click", function () {
            const certificados = document.querySelectorAll(".certificado-individual");
            if (certificados.length > 0) {
                generarZIP(Array.from(certificados));
            } else {
                alert("No hay certificados para descargar.");
            }
        });
    });
    </script>
@stop
