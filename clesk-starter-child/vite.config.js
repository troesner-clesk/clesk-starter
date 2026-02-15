import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    build: {
        outDir: 'dist',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                custom: resolve(__dirname, 'src/css/custom.css'),
            },
            output: {
                assetFileNames: '[name].[ext]',
            },
        },
    },
});
