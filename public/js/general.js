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
    '1': (estudiante) => {
        const qrId = `qr-${estudiante.id}`;
        return `
            <div class="diploma-1" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
                <div id="${qrId}" class="qr-code"></div>
            </div>
        `;
    },
    '2': (estudiante) => {
        const qrId = `qr-${estudiante.id}`;
        return `
            <div class="diploma-2" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
                <div id="${qrId}" class="qr-code"></div>
            </div>
        `;
    },
    '3': (estudiante) => {
        const qrId = `qr-${estudiante.id}`;
        return `
            <div class="diploma-3" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
                <div id="${qrId}" class="qr-code"></div>
            </div>
        `;
    },
    '4': (estudiante) => {
        const qrId = `qr-${estudiante.id}`;
        return `
            <div class="diploma-4" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
                <div id="${qrId}" class="qr-code"></div>
            </div>
        `;
    },
    '5': (estudiante) => {
        const qrId = `qr-${estudiante.id}`;
        return `
            <div class="diploma-5" id="diploma-${estudiante.id}">
                <div class="nombre"><u>${estudiante.nombreCompleto}</u></div>
                <div class="curso">${estudiante.curso}</div>
                <div class="modalidad"><u>${estudiante.modalidad}</u></div>
                <div class="duracion"><u>${estudiante.duracion}</u></div>
                <div class="fecha-finalizacion">${estudiante.fechaFinalizacion}</div>
                <div class="fecha-emision">${estudiante.fechaEmision}</div>
                <div class="tutor">${estudiante.tutor}</div>
                <div id="${qrId}" class="qr-code"></div>
            </div>
        `;
    }
};

// Función para generar códigos QR
function generarCodigosQR() {
    estudiantes.forEach(estudiante => {
        const qrId = `qr-${estudiante.id}`;
        const qrData = `Diploma: ${estudiante.curso}\nNombre: ${estudiante.nombreCompleto}\nFecha: ${estudiante.fechaEmision}\nTutor: ${estudiante.tutor}`;
        
        // Verificar si el elemento existe antes de crear el QR
        const qrElement = document.getElementById(qrId);
        if (qrElement) {
            new QRCode(qrElement, {
                text: qrData,
                width: 80,
                height: 80,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
}

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
        document.getElementById('iconoTema').src = "vendor/adminlte/dist/img/night.png";
    }
});

function alternarModoOscuro() {
    document.body.classList.toggle('dark-mode');
    const modoOscuroActivado = document.body.classList.contains('dark-mode');
    localStorage.setItem('modoOscuro', modoOscuroActivado);
    
    const icono = document.getElementById('iconoTema');
    if (modoOscuroActivado) {
        icono.src = "vendor/adminlte/dist/img/night.png";
        icono.style.transform = 'rotate(360deg)';
    } else {
        icono.src = "vendor/adminlte/dist/img/day.png";
        icono.style.transform = 'rotate(0deg)';
    }
}

function procesarArchivoCSV(archivo) {
    const lector = new FileReader();
    
    lector.onload = function(evento) {
        const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
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

        // Validar metadatos
        if (!metadatos.curso || !metadatos.tutor || !metadatos.fechaFinalizacion || !metadatos.modalidad || !metadatos.duracion) {
            alert("Error: El archivo CSV no contiene todos los metadatos necesarios (Curso, Tutor, Fecha de Finalización, Modalidad, Duración)");
            return;
        }

        // Buscar encabezado de estudiantes
        const indiceEncabezado = lineas.findIndex(linea => linea.includes('Nombre;Nota Final'));
        if (indiceEncabezado === -1) {
            alert("Error: El CSV no tiene la cabecera 'Nombre;Nota Final'");
            return;
        }

        estudiantes = [];
        // Procesar estudiantes
        for (let i = indiceEncabezado + 1; i < lineas.length; i++) {
            const celdas = lineas[i].split(';').map(c => c.trim());
            const nombre = celdas[0];
            
            if (nombre && nombre.length > 0 && !nombre.startsWith(';;') && !nombre.startsWith('===')) {
                estudiantes.push({
                    id: i,
                    nombreCompleto: nombre,
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
    const contenido = `Cooperativa de Ahorro y Crédito Talanga LTDA

INSTRUCCIONES:
1. Complete los datos del curso abajo, reemplace los datos que se le piden en cada celda
2. Escriba los nombres de los participantes en la lista
3. No use tildes ni modifique la estructura
4. Guarde el archivo como CSV (delimitado por punto y coma)

Curso:;Nombre del curso
Tutor:;Nombre del tutor
Tipo Documento:;Certificado
Modalidad:;Presencial/Virtual
Duracion:;X horas/dias/meses
Fecha de finalizacion:;DD/MM/AAAA

Alumnos Aprobados
Nombre;Nota Final
Nombre1;100
Nombre2;70`;

    const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
    const enlace = document.createElement('a');
    enlace.href = URL.createObjectURL(blob);
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
    
    // Generar códigos QR después de crear los diplomas
    setTimeout(generarCodigosQR, 100);
    
    document.getElementById('botonDescargarTodos').style.display = 'inline-block';
    document.getElementById('generated-diplomas').style.display = 'block';
    document.getElementById('botonGenerar').disabled = true;
    
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
        // Mostrar mensaje de carga
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = `
            <div class="loading-content">
                <h3>Generando archivo ZIP</h3>
                <p>Por favor espere, esto puede tomar varios minutos...</p>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                <p id="progress-text">0/${estudiantes.length} diplomas procesados</p>
            </div>
        `;
        document.body.appendChild(loadingOverlay);
        
        const archivoZip = new JSZip();
        const folder = archivoZip.folder("Diplomas");
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        
        // Procesar en lotes para mejor rendimiento
        const batchSize = 3;
        let processed = 0;
        
        for (let i = 0; i < estudiantes.length; i += batchSize) {
            const batch = estudiantes.slice(i, i + batchSize);
            const batchPromises = batch.map(async (estudiante, batchIndex) => {
                const indice = i + batchIndex;
                const elemento = document.getElementById(`diploma-${estudiante.id}`);
                
                const lienzo = await html2canvas(elemento, { 
                    useCORS: true,
                    scale: 1.5,
                    logging: false,
                    allowTaint: true
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
        
        // Eliminar overlay de carga
        document.body.removeChild(loadingOverlay);
        
    } catch (error) {
        console.error('Error al generar ZIP:', error);
        alert("Error al generar el archivo ZIP. Por favor intente con menos diplomas o recargue la página.");
        
        // Eliminar overlay de carga en caso de error
        const loadingOverlay = document.querySelector('.loading-overlay');
        if (loadingOverlay) {
            document.body.removeChild(loadingOverlay);
        }
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