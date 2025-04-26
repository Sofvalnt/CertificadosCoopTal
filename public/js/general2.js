// Variables globales
let estudiantes = [];
let metadatos = {
    cooperativa: 'Cooperativa de Ahorro y Crédito Talanga LTDA',
    curso: '',
    tutor: '',
    modalidad: '',
    duracion: '',
    fechaFinalizacion: ''
};

/// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('botonModoOscuro').addEventListener('click', alternarModoOscuro);
    document.getElementById('archivoCSV').addEventListener('change', procesarArchivoCSV);
    document.getElementById('botonGenerar').addEventListener('click', generarDiplomas);
    document.getElementById('botonDescargarTodos').addEventListener('click', descargarTodos);
    document.getElementById('refrescarBtn').addEventListener('click', refrescarDiplomas);
    document.getElementById('descargarPlantillaBtn').addEventListener('click', descargarPlantilla);

    // Verificar modo oscuro al cargar
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark-mode');
        document.getElementById('iconoTema').src = "/vendor/adminlte/dist/img/night.png";
        document.getElementById('certificado-preview').src = "/vendor/adminlte/dist/img/general2.png";
    }
});

// Función para alternar modo oscuro
function alternarModoOscuro() {
    document.body.classList.toggle('dark-mode');
    const modoOscuroActivado = document.body.classList.contains('dark-mode');
    localStorage.setItem('modoOscuro', modoOscuroActivado);
    
    const icono = document.getElementById('iconoTema');
    if (modoOscuroActivado) {
        icono.src = "/vendor/adminlte/dist/img/night.png";
        icono.style.transform = 'rotate(360deg)';
        document.getElementById('certificado-preview').src = "/vendor/adminlte/dist/img/general2.png";
    } else {
        icono.src = "/vendor/adminlte/dist/img/day.png";
        icono.style.transform = 'rotate(0deg)';
        document.getElementById('certificado-preview').src = "/vendor/adminlte/dist/img/general2.png";
    }
}
function refrescarDiplomas() {
    if (confirm("¿Estás seguro de que deseas eliminar todos los diplomas generados?")) {
        estudiantes = [];
        document.getElementById('contenedor').innerHTML = '';
        document.getElementById('botonGenerar').disabled = true;
        document.getElementById('botonDescargarTodos').style.display = 'none';
        alert("Los diplomas han sido eliminados.");
    }
}


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

function procesarArchivoCSV(evento) {
    const archivo = evento.target.files[0];
    if (!archivo) return;

    const lector = new FileReader();
    
    lector.onload = function(evento) {
        try {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Extraer metadatos
            for (let i = 0; i < lineas.length; i++) {
                const linea = lineas[i];
                if (linea.startsWith('Curso:')) {
                    metadatos.curso = linea.split(';')[1]?.trim() || '';
                } else if (linea.startsWith('Tutor:')) {
                    metadatos.tutor = linea.split(';')[1]?.trim() || '';
                } else if (linea.startsWith('Tipo Documento:')) {
                    metadatos.tipoDocumento = linea.split(';')[1]?.trim() || '';
                } else if (linea.startsWith('Modalidad:')) {
                    metadatos.modalidad = linea.split(';')[1]?.trim() || '';
                } else if (linea.startsWith('Duracion:')) {
                    metadatos.duracion = linea.split(';')[1]?.trim() || '';
                } else if (linea.startsWith('Fecha de finalizacion:')) {
                    metadatos.fechaFinalizacion = linea.split(';')[1]?.trim() || '';
                }
            }

            // Buscar inicio de la lista de estudiantes
            estudiantes = [];
            let encontroEncabezado = false;
            
            for (let i = 0; i < lineas.length; i++) {
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
                    
                    // Detener si encontramos una línea vacía o con separadores
                    if (linea === '' || linea.startsWith('===') || linea.startsWith(';;')) {
                        break;
                    }
                    
                    // Solo procesar si hay un nombre válido
                    if (nombre && nombre.length > 0 && !/^[;=\s]+$/.test(nombre)) {
                        estudiantes.push({
                            nombreCompleto: nombre,
                            ...metadatos,
                            fechaEmision: new Date().toLocaleDateString('es-ES', { 
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            }),
                            codigoVerificacion: generarCodigoUnico(nombre)
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
        } catch (error) {
            console.error('Error al procesar el archivo:', error);
            alert("Error al procesar el archivo. Verifique el formato.");
            document.getElementById('botonGenerar').disabled = true;
        }
    };
    
    lector.onerror = function() {
        alert("Error al leer el archivo");
        document.getElementById('botonGenerar').disabled = true;
    };
    
    lector.readAsArrayBuffer(archivo);
}

function generarCodigoUnico(nombre) {
    const timestamp = new Date().getTime();
    const random = Math.floor(Math.random() * 10000);
    return `${nombre.substring(0, 3).toUpperCase()}${timestamp}${random}`;
}

function generarQR(codigo) {
    const urlVerificacion = `${window.location.origin}/verificar/${codigo}`;
    
    const qr = qrcode(0, 'H');
    qr.addData(urlVerificacion);
    qr.make();
    
    const qrImg = document.createElement('img');
    qrImg.src = qr.createDataURL(4, 10);
    qrImg.className = 'qr-code';
    qrImg.alt = 'Código QR de verificación';
    qrImg.title = 'Escanear para verificar autenticidad';
    
    return qrImg;
}

async function generarDiplomas() {
    const contenedor = document.getElementById('contenedor');
    contenedor.innerHTML = '';
    
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'loading-overlay';
    loadingOverlay.innerHTML = `
        <div class="loading-content">
            <h3>Generando Diplomas</h3>
            <p>Por favor espere, generando ${estudiantes.length} diplomas...</p>
            <div class="progress-bar">
                <div class="progress" id="diploma-progress"></div>
            </div>
            <p id="diploma-progress-text">0/${estudiantes.length} diplomas generados</p>
        </div>
    `;
    document.body.appendChild(loadingOverlay);
    
    try {
        for (let i = 0; i < estudiantes.length; i++) {
            const estudiante = estudiantes[i];
            const diplomaDiv = document.createElement('div');
            diplomaDiv.className = 'certificado-item';
            
            const diploma = document.createElement('div');
            diploma.className = 'diploma';
            diploma.id = `diploma-${i}`;
            
            const elementos = [
                { className: 'nombre', text: estudiante.nombreCompleto },
                { className: 'curso', text: estudiante.curso },
                { className: 'modalidad', text: estudiante.modalidad },
                { className: 'duracion', text: estudiante.duracion },
                { className: 'fecha-finalizacion', text: estudiante.fechaFinalizacion },
                { className: 'fecha-emision', text: estudiante.fechaEmision },
                { className: 'tutor', text: estudiante.tutor }
            ];
            
            elementos.forEach(elemento => {
                const el = document.createElement('div');
                el.className = elemento.className;
                el.textContent = elemento.text;
                diploma.appendChild(el);
            });
            
            const qrCode = generarQR(estudiante.codigoVerificacion);
            diploma.appendChild(qrCode);
            
            const botonDescargar = document.createElement('button');
            botonDescargar.className = 'btn-descargar';
            botonDescargar.textContent = `Descargar Diploma ${i + 1}`;
            botonDescargar.addEventListener('click', () => descargarDiploma(i));
            
            diplomaDiv.appendChild(diploma);
            diplomaDiv.appendChild(botonDescargar);
            contenedor.appendChild(diplomaDiv);
            
            const progress = (i + 1) / estudiantes.length * 100;
            document.getElementById('diploma-progress').style.width = `${progress}%`;
            document.getElementById('diploma-progress-text').textContent = 
                `${i + 1}/${estudiantes.length} diplomas generados`;
            
            await new Promise(resolve => setTimeout(resolve, 50));
        }
        
        document.getElementById('botonDescargarTodos').style.display = 'inline-block';
        document.getElementById('botonGenerar').disabled = true;
        
    } catch (error) {
        console.error('Error al generar diplomas:', error);
        alert("Error al generar los diplomas. Por favor intente nuevamente.");
    } finally {
        document.body.removeChild(loadingOverlay);
    }
}

async function descargarDiploma(indice) {
    try {
        const elemento = document.getElementById(`diploma-${indice}`);
        const estudiante = estudiantes[indice];
        
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = `
            <div class="loading-content">
                <h3>Generando Diploma</h3>
                <p>Por favor espere, generando diploma para ${estudiante.nombreCompleto}...</p>
            </div>
        `;
        document.body.appendChild(loadingOverlay);
        
        const lienzo = await html2canvas(elemento, { 
            useCORS: true, 
            scale: 2,
            backgroundColor: null,
            logging: true
        });
        
        const enlace = document.createElement('a');
        enlace.download = `Diploma_${estudiante.nombreCompleto.replace(/ /g, '_')}.png`;
        enlace.href = lienzo.toDataURL('image/png');
        enlace.click();
        
    } catch (error) {
        console.error('Error al generar diploma:', error);
        alert("Error al generar el diploma");
    } finally {
        if (document.body.contains(loadingOverlay)) {
            document.body.removeChild(loadingOverlay);
        }
    }
}

async function descargarTodos() {
    try {
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
        
        const batchSize = 2;
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
                    datos: lienzo.toDataURL('image/png', 0.9)
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
            
            await new Promise(resolve => setTimeout(resolve, 200));
        }
        
        const contenido = await archivoZip.generateAsync({ 
            type: "blob",
            compression: "DEFLATE",
            compressionOptions: { level: 6 }
        });
        
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(contenido);
        enlace.download = "Diplomas.zip";
        enlace.click();
        
    } catch (error) {
        console.error('Error al generar ZIP:', error);
        alert("Error al generar el archivo ZIP. Por favor intente con menos diplomas o recargue la página.");
    } finally {
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