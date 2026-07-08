/**
 * Copy CMS DS CSS into assets/vendor/cmsds/ for offline / production installs.
 * Run: npm install && npm run vendor:cmsds
 */
import { copyFileSync, mkdirSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = join(dirname(fileURLToPath(import.meta.url)), '..');
const fromDir = join(root, 'node_modules', '@cmsgov', 'ds-cms-gov', 'dist', 'css');
const toDir = join(root, 'assets', 'vendor', 'cmsds');

const files = ['cmsgov-theme.css', 'index.css'];

mkdirSync(toDir, { recursive: true });

for (const file of files) {
  copyFileSync(join(fromDir, file), join(toDir, file));
  console.log('Copied', file);
}
