#!/bin/bash
set -e

PHP="/opt/plesk/php/8.5/bin/php"
COMPOSER="/usr/local/bin/composer"
ROOT="/var/www/vhosts/vacanzare.com/httpdocs"

cd "$ROOT"

echo "==> Rimozione file di sviluppo..."
rm -f ray.php

echo "==> Composer install (solo produzione)..."
$COMPOSER install --no-dev --optimize-autoloader

echo "==> Pulizia cache..."
rm -f bootstrap/cache/packages.php \
      bootstrap/cache/services.php \
      bootstrap/cache/config.php \
      bootstrap/cache/routes-v7.php \
      bootstrap/cache/blade-icons.php

echo "==> Ricostruzione cache..."
$PHP artisan cache:clear
$PHP artisan view:clear
$PHP artisan package:discover
$PHP artisan config:cache
$PHP artisan route:clear
$PHP artisan view:cache

echo "==> Migrazioni..."
$PHP artisan migrate --force

echo "==> Deploy completato!"
