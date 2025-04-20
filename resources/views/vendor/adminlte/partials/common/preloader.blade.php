<<<<<<< HEAD

<div id="elegant-page-loader" 
     style="position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;">
    
    {{-- Contenedor principal --}}
    <div style="position: relative;
                width: 180px;
                height: 180px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;">
        
        {{-- Logo con efecto sutil --}}
        <img src="{{ asset(config('adminlte.preloader.img.path', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}" 
             style="width: 80px;
                    height: 80px;
                    filter: drop-shadow(0 2px 5px rgba(0,0,0,0.1));
                    animation: subtle-bounce 2s ease-in-out infinite;">
        
        {{-- Anillo de progreso --}}
        <div style="position: absolute;
                   width: 120px;
                   height: 120px;
                   border: 3px solid rgba(60, 141, 188, 0.1);
                   border-radius: 50%;
                   border-top-color: #3c8dbc;
                   animation: spin 1.2s linear infinite;">
        </div>
        
        {{-- Puntos decorativos --}}
        <div style="position: absolute;
                   bottom: 15px;
                   display: flex;
                   gap: 8px;">
            <div style="width: 10px;
                       height: 10px;
                       background: #e74c3c;
                       border-radius: 50%;
                       animation: pulse 1s infinite ease-in-out;"></div>
            <div style="width: 10px;
                       height: 10px;
                       background: #f39c12;
                       border-radius: 50%;
                       animation: pulse 1s infinite ease-in-out 0.2s;"></div>
            <div style="width: 10px;
                       height: 10px;
                       background: #2ecc71;
                       border-radius: 50%;
                       animation: pulse 1s infinite ease-in-out 0.4s;"></div>
        </div>
    </div>

    <style>
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
        
        @keyframes subtle-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.2); opacity: 1; }
        }
    </style>

    <script>
        // Controlador optimizado
        (function() {
            const loader = document.getElementById('elegant-page-loader');
            let pageTransition = false;
            
            // Mostrar durante transiciones
            window.addEventListener('beforeunload', () => {
                pageTransition = true;
                loader.style.opacity = '1';
                loader.style.pointerEvents = 'auto';
            });
            
            // Ocultar al cargar (con retraso mínimo)
            window.addEventListener('load', () => {
                if (pageTransition) {
                    setTimeout(() => {
                        loader.style.opacity = '0';
                        setTimeout(() => {
                            loader.style.pointerEvents = 'none';
                            pageTransition = false;
                        }, 400);
                    }, 600); // Duración reducida
                }
            });
            
            // Forzar ocultamiento si la página carga muy rápido
            setTimeout(() => {
                if (!pageTransition && loader.style.opacity === '1') {
                    loader.style.opacity = '0';
                    loader.style.pointerEvents = 'none';
                }
            }, 1500);
        })();
    </script>
</div>
=======
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

<div class="{{ $preloaderHelper->makePreloaderClasses() }}" style="{{ $preloaderHelper->makePreloaderStyle() }}">

    @hasSection('preloader')

        {{-- Use a custom preloader content --}}
        @yield('preloader')

    @else

        {{-- Use the default preloader content --}}
        <img src="{{ asset(config('adminlte.preloader.img.path', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
             class="img-circle {{ config('adminlte.preloader.img.effect', 'animation__shake') }}"
             alt="{{ config('adminlte.preloader.img.alt', 'AdminLTE Preloader Image') }}"
             width="{{ config('adminlte.preloader.img.width', 60) }}"
             height="{{ config('adminlte.preloader.img.height', 60) }}"
             style="animation-iteration-count:infinite;">

    @endif

</div>
>>>>>>> 0ca187b08f2b21bfccecc6bd75900ab33dc4e5f7
