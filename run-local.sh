#!/usr/bin/env bash
set -euo pipefail
if ! command -v composer >/dev/null; then echo 'Composer is required. See README.md.'; exit 1; fi
if ! command -v php >/dev/null; then echo 'PHP 8.3+ is required.'; exit 1; fi
if [[ ! -f .env ]]; then echo 'Copy .env.example to .env and configure ADMIN_EMAIL and ADMIN_PASSWORD, then rerun.'; exit 1; fi
composer install
npm install
if ! grep -q '^APP_KEY=base64:' .env; then php artisan key:generate; fi
mkdir -p database
if [[ ! -f database/database.sqlite ]]; then touch database/database.sqlite; fi
php artisan migrate --seed
php artisan storage:link || true
npm run build
exec php artisan serve --host=127.0.0.1 --port=8000
