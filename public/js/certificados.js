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
    const refrescarBtnFixed = document.getElementById('refrescarBtnFixed');
    const eliminarBtn = document.getElementById('eliminarBtn');
    const eliminarBtnFixed = document.getElementById('eliminarBtnFixed');
    const contenedor = document.getElementById('contenedor-certificados');
    const nombreArchivo = document.getElementById('nombre-archivo');

    // Variables globales
    let participantes = [];
    let textoCertificado = '';
    let diseñoActual = '1';
    const imagenesDisenos = {
        '1': 'vendor/adminlte/dist/img/participacion.png',
        '2': 'vendor/adminlte/dist/img/reconocimiento.png'
    };
    const imagenesDisenosDark = {
        '1': 'vendor/adminlte/dist/img/participacion.png',
        '2': 'vendor/adminlte/dist/img/reconocimiento.png'
    };
    
    // URL base para validación de certificados
    const urlValidacion = window.location.origin + '/validar-certificado';

    // Plantillas de generación para cada diseño
    const plantillasGeneracion = {
        '1': (participante) => `
            <div class="certificado-1" id="certificado-${participante.id}">
                <div class="nombre-certificado">${participante.nombre}</div>
                <div class="texto-certificado">${textoCertificado || 'Por su destacada participación y contribución en nuestro programa'}</div>
                <div class="fecha-certificado">Fecha: ${new Date().toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                <div class="qr-container" id="qr-${participante.id}"></div>
            </div>
        `,
        '2': (participante) => `
            <div class="certificado-2" id="certificado-${participante.id}">
                <div class="nombre-certificado">${participante.nombre}</div>
                <div class="texto-certificado">${textoCertificado || 'Por su excelente desempeño y logros alcanzados'}</div>
                <div class="fecha-certificado">Fecha: ${new Date().toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                <div class="qr-container" id="qr-${participante.id}"></div>
            </div>
        `
    };

    // Inicializar eventos
    function initEventListeners() {
        // Selector de diseño
        document.querySelectorAll('.design-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.design-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                diseñoActual = this.getAttribute('data-design');
                actualizarVistaPrevia();
            });
        });

        // Cambio de archivo CSV
        archivoCSV.addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                nombreArchivo.textContent = archivo.name;
                botonGenerar.disabled = false;
                procesarArchivoCSV(archivo);
            }
        });

        // Botones
        descargarPlantillaBtn.addEventListener('click', descargarPlantilla);
        botonGenerar.addEventListener('click', generarCertificados);
        botonDescargarTodos.addEventListener('click', descargarTodos);
        refrescarBtn.addEventListener('click', refrescarCertificados);
        refrescarBtnFixed.addEventListener('click', refrescarCertificados);
        eliminarBtn.addEventListener('click', eliminarCertificados);
        eliminarBtnFixed.addEventListener('click', eliminarCertificados);
        botonModoOscuro.addEventListener('click', alternarModoOscuro);
    }

    // Función para generar un código único
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

    function actualizarVistaPrevia() {
        const modoOscuro = document.body.classList.contains('dark-mode');
        const imagen = modoOscuro ? imagenesDisenosDark[diseñoActual] : imagenesDisenos[diseñoActual];
        certificadoPreview.src = imagen;
        document.getElementById(`preview-design-${diseñoActual}`).src = imagen;
    }

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
        
        actualizarVistaPrevia();
    }

    function procesarArchivoCSV(archivo) {
        const lector = new FileReader();
        
        lector.onload = function(evento) {
            const texto = new TextDecoder('utf-8').decode(new Uint8Array(evento.target.result));
            const lineas = texto.split('\n').map(linea => linea.trim());
            
            // Buscar texto del certificado
            const textoIndex = lineas.findIndex(linea => linea.startsWith('Texto a escribir en diploma:'));
            if (textoIndex !== -1) {
                textoCertificado = lineas[textoIndex].split(':')[1]?.trim() || '';
            }

            // Buscar nombres de participantes
            const nombresIndex = lineas.findIndex(linea => linea.startsWith('Nombre del participante'));
            participantes = [];
            
            if (nombresIndex !== -1) {
                for (let i = nombresIndex + 1; i < lineas.length; i++) {
                    if (lineas[i]) {
                        participantes.push({
                            id: i,
                            nombre: lineas[i].split(';')[0].trim(),
                            codigo: generarCodigoUnico()
                        });
                    }
                }
            }
            
            if (participantes.length === 0) {
                alert("No se encontraron participantes válidos en el archivo");
                botonGenerar.disabled = true;
            } else {
                alert(`Se han cargado ${participantes.length} participantes correctamente`);
            }
        };
        
        lector.onerror = function() {
            alert("Error al leer el archivo");
            botonGenerar.disabled = true;
        };
        
        lector.readAsArrayBuffer(archivo);
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

    function generarCertificados() {
        contenedor.innerHTML = '';
        
        participantes.forEach((participante, indice) => {
            const certificadoHTML = `
                <div class="certificado-item fade-in" style="animation-delay: ${indice * 0.1}s">
                    ${plantillasGeneracion[diseñoActual](participante)}
                    <button onclick="descargarCertificado(${indice})" class="btn" style="margin-top: 15px;">
                        <i class="fas fa-download"></i> Descargar Certificado ${indice + 1}
                    </button>
                </div>
            `;
            
            contenedor.innerHTML += certificadoHTML;
            
            // Generar QR después de crear el elemento
            setTimeout(() => {
                const qrContainer = document.getElementById(`qr-${participante.id}`);
                const urlValidacionCompleta = `${urlValidacion}?codigo=${participante.codigo}&nombre=${encodeURIComponent(participante.nombre)}`;
                generarQR(urlValidacionCompleta, qrContainer);
            }, 100);
        });
        
        botonDescargarTodos.style.display = 'inline-block';
        document.getElementById('generated-certificates').style.display = 'block';
        botonGenerar.disabled = true;
        
        document.getElementById('generated-certificates').scrollIntoView({ behavior: 'smooth' });
    }

    async function descargarCertificado(indice) {
        try {
            const elemento = document.getElementById(`certificado-${participantes[indice].id}`);
            const lienzo = await html2canvas(elemento, { 
                scale: 2,
                logging: false,
                backgroundColor: null,
                useCORS: true,
                allowTaint: true
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

    function refrescarCertificados() {
        if (participantes.length > 0) {
            generarCertificados();
            alert("Certificados refrescados correctamente");
        } else {
            alert("No hay certificados para refrescar. Por favor, genera certificados primero.");
        }
    }

    function eliminarCertificados() {
        if (confirm("¿Estás seguro de que deseas eliminar todos los certificados generados?")) {
            contenedor.innerHTML = '';
            botonDescargarTodos.style.display = 'none';
            botonGenerar.disabled = false;
            participantes = [];
            textoCertificado = '';
            nombreArchivo.textContent = 'No se ha seleccionado archivo';
            archivoCSV.value = '';
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
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
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="zip-progress"></div>
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

    // Verificar modo oscuro al cargar
    if (localStorage.getItem('modoOscuro') === 'true') {
        document.body.classList.add('dark-mode');
        iconoTema.src = iconoTema.src.replace('day.png', 'night.png');
        actualizarVistaPrevia();
    }

    // Inicializar la aplicación
    initEventListeners();

    // Hacer funciones accesibles globalmente para los eventos onclick en los botones de descarga
    window.descargarCertificado = descargarCertificado;
});