document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const botonModoOscuro = document.getElementById('botonModoOscuro');
    const iconoTema = document.getElementById('iconoTema');
    const certificadoPreview = document.getElementById('certificado-preview');
    const descargarPlantillaBtn = document.getElementById('descargarPlantillaBtn');
    const archivoCSV = document.getElementById('archivoCSV');
    const botonGenerar = document.getElementById('botonGenerar');
    const botonDescargarTodos = document.getElementById('botonDescargarTodos');
    const refrescarBtn = document.getElementById('refrescarBtn');
    const contenedor = document.getElementById('contenedor');

    let participantes = [];
    let datosCurso = {
        cooperativa: 'Cooperativa de Ahorro y Crédito Talanga LTDA',
        tutor: '',
        texto: '',
        urlValidacion: window.location.origin + '/validar-certificado' // URL para la validación
    };

    // Event Listeners
    botonModoOscuro.addEventListener('click', alternarModoOscuro);
    descargarPlantillaBtn.addEventListener('click', descargarPlantilla);
    archivoCSV.addEventListener('change', manejarArchivoCSV);
    botonGenerar.addEventListener('click', generarCertificados);
    botonDescargarTodos.addEventListener('click', descargarTodos);
    refrescarBtn.addEventListener('click', refrescarCertificados);

    // Verificar modo oscuro al cargar
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark-mode');
        iconoTema.src = iconoTema.src.replace('day.png', 'night.png');
        certificadoPreview.src = certificadoPreview.src.replace('participacion.png', 'participacion.png');
    }

    // Funciones
    function alternarModoOscuro() {
        document.body.classList.toggle('dark-mode');
        const modoOscuroActivado = document.body.classList.contains('dark-mode');
        localStorage.setItem('modoOscuro', modoOscuroActivado);
        
        if (modoOscuroActivado) {
            iconoTema.src = iconoTema.src.replace('day.png', 'night.png');
            iconoTema.style.transform = 'rotate(360deg)';
        } else {
            iconoTema.src = iconoTema.src.replace('night.png', 'day.png');
            iconoTema.style.transform = 'rotate(0deg)';
        }
    }

    function descargarPlantilla() {
        const contenido = `Cooperativa de Ahorro y Crédito Talanga LTDA

INSTRUCCIONES:
1. Escribir en la casilla el nombre de tutor deberá rellenar B10
2. Escriba el texto a escribir en el certificado en la casilla B11
3. Escriba el nombre del participante a certificar en lista hacia abajo,( por ejemplo, A13, A14, A15, A16,etc…)
4. No use tildes, ni modifique la estructura ya que  cada una esta en su lugar y orden especifico.
5. Cuando el archivo este completo guarde el archivo como CSV (delimitado por punto y coma), el archivo actual ya tiene es un CSV, solamente guardar.


Texto a escribir en diploma
Nombre del participante
`;

        const blob = new Blob([contenido], { type: 'text/csv;charset=utf-8;' });
        const enlace = document.createElement('a');
        enlace.href = URL.createObjectURL(blob);
        enlace.download = 'Plantilla_Certificado.csv';
        enlace.click();
    }

    function manejarArchivoCSV(evento) {
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
                botonGenerar.disabled = false;
                alert(`Se han cargado ${participantes.length} participantes correctamente`);
            } else {
                alert("No se encontraron participantes válidos en el archivo");
                botonGenerar.disabled = true;
            }
        };
        
        lector.onerror = function() {
            alert("Error al leer el archivo");
            botonGenerar.disabled = true;
        };
        
        lector.readAsArrayBuffer(archivo);
    }

    function generarCodigoUnico() {
        return 'CT-' + Math.random().toString(36).substr(2, 9).toUpperCase();
    }

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
        
        botonDescargarTodos.style.display = 'inline-block';
        botonGenerar.disabled = true;
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
            
            botonDescargarTodos.disabled = true;
            botonDescargarTodos.textContent = 'Generando...';
            
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
            botonDescargarTodos.disabled = false;
            botonDescargarTodos.textContent = 'Descargar Todos (ZIP)';
            
        } catch (error) {
            console.error('Error al generar ZIP:', error);
            alert("Error al generar el archivo ZIP. Por favor intente con menos certificados o recargue la página.");
            
            // Limpiar en caso de error
            const overlay = document.querySelector('.loading-overlay');
            if (overlay) document.body.removeChild(overlay);
            
            if (botonDescargarTodos) {
                botonDescargarTodos.disabled = false;
                botonDescargarTodos.textContent = 'Descargar Todos (ZIP)';
            }
        }
    }

    function refrescarCertificados() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los certificados generados?")) {
            contenedor.innerHTML = '';
            botonDescargarTodos.style.display = 'none';
            botonGenerar.disabled = false;
            participantes = [];
            archivoCSV.value = '';
        }
    }

    // Hacer funciones accesibles globalmente para los eventos onclick en los botones de descarga
    window.descargarCertificado = descargarCertificado;
});