<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    |
    */

    'title' => 'Certificados/Diplomas',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    */

    'logo' => '
    <div style="text-align: center;">
        <img src="/vendor/adminlte/dist/img/AdminLTELogo.png" alt="Logo" style="height: 60px; margin-bottom: 5px;"><br>
        <div style="font-size: 1.3rem; font-weight: bold; line-height: 1.3;">
            Cooperativa de Ahorro<br> y Crédito<br>"Talanga" LTDA
        </div>
    </div>',


    'logo_img' => ' ',
    'logo_img_class' => 'v',
    'logo_img_xl' => null,
    'logo_img_xl_class' => ' ',
    'logo_img_alt' => ' ',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    |
    */

    // 'auth_logo' => [
    //     'enabled' => true,
    //     'img' => [
    //         'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    //         'alt' => 'Auth Logo',
    //         'class' => '',
    //         'width' => 140,
    //         'height' => 140,
    //     ],
    // ],


    
    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    |
    */

    // 'preloader' => [
    //     'enabled' => true,
    //     'mode' => 'fullscreen',
    //     'img' => [
    //         'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    //         'alt' => 'AdminLTE Preloader Image',
    //         'width' => 200,
    //         'height' => 200,
    //     ],
    // ],

    'preloader' => [
    'enabled' => true,
    'theme' => 'certificate', // Temática especial para certificados
    'animation' => [
        'type' => 'confetti', // Nuevo tipo de animación
        'colors' => ['#4CAF50', '#2196F3', '#FFC107', '#FF5722'], // Colores alegres
    ],
    'img' => [
        'enabled' => true,
        'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png', // Tu logo para certificados
        'width' => 120,
        'height' => 120,
        'animation' => 'none', // Logo estático
    ],
    'text' => [
        'enabled' => true,
        'content' => 'Generando tu certificado...',
        'color' => '#2E7D32', // Verde oscuro elegante
        'animation' => 'typewriter', // Efecto máquina de escribir
    ],
    'background' => 'rgba(255, 255, 255, 0.95)', // Fondo blanco semi-transparente
    'elements' => [ // Nuevos elementos decorativos
        'stars' => true,
        'border_animation' => true,
    ],
    'autohide' => false, // Controlado manualmente para certificados
    'progress' => true, // Barra de progreso para generación
],
    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    */

    'classes_auth_card' => 'bg-gradient-dark',
    'classes_auth_header' => '',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-fw text-success',
    'classes_auth_btn' => 'btn-flat btn-success',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    
    | Here you can change the look and behavior of the admin panel.
    |
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => true,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    */

    'menu' => [
    // Navbar items:
    [
        'text' => '<img src="'.asset('vendor/adminlte/dist/img/day.png').'" id="themeIcon" width="20">',
        'topnav_right' => true,
        'classes' => 'dark-mode-btn', // Clase importante
        'attributes' => [
            'onclick' => "toggleDarkMode(); return false;",
            'style' => 'padding: 0.5rem;'
        ],
    ],
    [
        'type' => 'fullscreen',
        'topnav_right' => true,
    ],

    // Sidebar items:
    [
        'type' => 'sidebar-menu-search',
        'text' => 'search',
    ],
    [
        'text' => 'Principal',
        'url' => 'dashboard',
        'icon' => 'fa fa-globe',
    ],
    [
        'text' => 'Generador de diplomas',
        'url' => 'generacion',
        'icon' => 'fa fa-graduation-cap',
    ],
    [
        'text' => 'Generador de Certificados',
        'url' => 'generacionCertificados',
        'icon' => 'fa fa-graduation-cap',
    ],
    [
        'header' => 'DIPLOMAS'
    ],
    
    [
        'text' => 'Individual',
        'icon' => 'far fa-fw fa-folder',
        'submenu' => [
            [   
                'text' => 'Para instructores',
                'url' => 'reconocimiento',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [   
                'text' => 'Para participantes',
                'url' => 'participacion',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [   
                'text' => 'Diploma General 1',
                'url' => 'generador',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [
                'text' => 'Diploma General 2',
                'url' => 'general',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [
                'text' => 'Comite de Juventud',
                'url' => 'juventud',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [
                'text' => 'Comite de Genero',
                'url' => 'genero',
                'icon' => 'fas fa-fw fa-certificate',
            ],
            [
                'text' => 'Comite de Educación',
                'url' => 'educacion',
                'icon' => 'fas fa-fw fa-certificate',
            ],
        ]
    ],

    [
        'header' => 'GENERAL'
    ],

    [
        'text' => 'Perfil',
        'url' => 'perfil',
        'icon' => 'fas fa-fw fa-user',
    ],
    
    [
        'text' => 'Ir a Classroom',
        'url' => 'https://classroom.google.com/?pli=1',
        'icon' => 'fas fa-fw fa-laptop',
        'target' => '_blank'
    ],
    
   
],
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 15,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    |
    */

    'livewire' => false,
];
