import { resolve } from 'node:path';
import { defineConfig } from 'vite';
import tsconfigPaths from 'vite-tsconfig-paths';
import tailwindcss from '@tailwindcss/vite';

const parserOptions = require('./.eslintrc.js').parserOptions

const base = '/';
const assetsDir = 'assets';
const root = resolve(__dirname, 'app/res');
const outDir = resolve(__dirname, 'site/static');

export default defineConfig(() => {
  return {
    root,
    base,
    build: {
      outDir,
      assetsDir,
      emptyOutDir: true,
      manifest: true,
      rollupOptions: {
        output: {
          manualChunks: undefined,
        },
      },
    },
    plugins: [
      tailwindcss(),
      tsconfigPaths({
        root: parserOptions.tsconfigRootDir,
        projects: parserOptions.project,
      })
    ],
    preview: {
      headers: {
        'Cache-Control': 'public, max-age=600',
      },
    },
    alias: {
      '~': root,
    },
  };
});
