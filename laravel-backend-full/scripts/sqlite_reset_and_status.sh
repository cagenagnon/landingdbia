#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

echo "[1] Reset sqlite file"
rm -f database/database.sqlite
touch database/database.sqlite

echo "[2] Clear Laravel caches"
php artisan optimize:clear

echo "[3] Composer autoload"
composer dump-autoload

echo "[4] Run migrations fresh"
php artisan migrate:fresh --force

echo "[5] Migration status"
php artisan migrate:status
