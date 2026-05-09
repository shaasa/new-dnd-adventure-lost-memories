#!/bin/bash
set -e

PHP="/opt/plesk/php/8.5/bin/php"
ARTISAN="$PHP artisan"
ROOT="/var/www/vhosts/vacanzare.com/httpdocs"

cd "$ROOT"

echo "==> Pull dal repository..."
git pull

echo "==> Rimozione file di sviluppo..."
rm -f ray.php

echo "==> Composer install (solo produzione)..."
composer install --no-dev --optimize-autoloader

echo "==> npm build..."
npm ci
npm run build

echo "==> Pulizia cache..."
rm -f bootstrap/cache/packages.php \
      bootstrap/cache/services.php \
      bootstrap/cache/config.php \
      bootstrap/cache/routes-v7.php \
      bootstrap/cache/blade-icons.php

$ARTISAN cache:clear
$ARTISAN view:clear

echo "==> Ricostruzione cache..."
$ARTISAN package:discover
$ARTISAN config:cache
$ARTISAN route:cache
$ARTISAN view:cache

echo "==> Migrazioni..."
$ARTISAN migrate --force

echo "==> Deploy completato!"
