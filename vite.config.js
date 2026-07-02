import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/neo-brutalism.css',
                'resources/css/landing.css',
                'resources/css/auth.css',
                'resources/js/app.js',
                'resources/js/landing.js',
            ],
            refresh: true,
        }),
    ],
});
