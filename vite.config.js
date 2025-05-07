import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true, // Enable HTTPS for the development server
        host: '0.0.0.0', // Allow external access (useful for Azure)
        port: 5173, // Default Vite port
    },
    build: {
        manifest: true, // Ensure the manifest is generated for Laravel
    },
});