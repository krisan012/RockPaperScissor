import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path';

// https://vite.dev/config/
export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './src'), // Ensure correct path
        },
    },
    server: {
        host: true, // Ensure the server is accessible externally
        watch: {
            usePolling: true, // Enable polling for file changes
            interval: 100,    // Check every 100ms (adjust as needed)
        }
    },
})
