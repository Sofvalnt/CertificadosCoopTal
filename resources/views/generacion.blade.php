@extends('adminlte::page')

@section('title', 'Generador de diplomas')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Generador de Diplomas</title>
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
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
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="{{ asset('js/general.js') }}"></script>
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