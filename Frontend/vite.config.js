import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
  plugins: [react()],
  css: {
    postcss: 'postcss.config.cjs', // Asegúrate de que esto coincida con el nombre del archivo renombrado si usas .cjs
  },
  resolve: {
    alias: {
      '@src': path.resolve(__dirname, './src'),
    },
  },
  build: {
    outDir: 'build', // Directorio de salida
    sourcemap: true, // Habilitar sourcemaps
  },
  server: {
    host: true, // Escuchar en todas las interfaces
    port: 3000, // Puedes cambiar el puerto si lo deseas
  },
});
