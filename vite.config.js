import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/diploma.css',
                'resources/js/diploma.js',
                'resources/css/educacion.css',
                'resources/js/educacion.js',
                'resources/css/juventud.css',
                'resources/js/juventud.js',
                'resources/css/general2.css',
                'resources/js/general2.js',
                'resources/css/genero.css',
                'resources/js/genero.js',
                'resources/css/participacion.css',
                'resources/js/participacion.js',
                'resources/css/reconocimiento.css',
                'resources/js/reconocimiento.js',

            ],
            refresh: true,
        }),
    ],
});
