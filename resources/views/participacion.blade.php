@extends('adminlte::page')

@section('title', 'Generador de Certificados')

@section('content_header')
<h1><center>Generador de Certificados de Participación</center></h1>
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
<div class="container-fluid">
    <!-- Botón de modo oscuro -->
    <button id="botonModoOscuro">
        <img src="{{ asset('vendor/adminlte/dist/img/day.png') }}" alt="Modo Claro" id="iconoTema" width="40" height="40">
    </button>

    <div class="contenedor-imagen">
        <div class="marco-imagen">
            <img src="{{ asset('vendor/adminlte/dist/img/participacion.png') }}" alt="Imagen" class="imagen-interactiva" id="certificado-preview">
            <div class="pie-imagen">Vista previa del diseño</div>
        </div>
    </div>

    <div class="botones">
        <div class="grupo-botones">
            <button id="descargarPlantillaBtn">Descargar Plantilla</button> 
        </div>
        
        <div class="grupo-botones">
            <input type="file" id="archivoCSV" accept=".csv">
            <button id="botonGenerar" disabled>Generar Certificados</button>
            <button id="botonDescargarTodos">Descargar Todos (ZIP)</button>
            <button id="refrescarBtn">Refrescar</button>
        </div>
    </div>

    <div id="contenedor"></div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/participacion.css') }}">
<style>
    .sidebar {
        font-size: 14px;
    }
</style>
@stop

@section('js')
<!-- Librerías necesarias -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>

<!-- Script principal -->
<script src="{{ asset('js/participacion.js') }}"></script>
@stop