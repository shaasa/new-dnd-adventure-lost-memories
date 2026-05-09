#!/bin/sh
set -e

echo "==> Rimozione file di sviluppo..."
rm -f ray.php

echo "==> Composer install (solo produzione)..."
composer install --no-dev --optimize-autoloader

echo "==> Pulizia cache..."
rm -f bootstrap/cache/packages.php \
      bootstrap/cache/services.php \
      bootstrap/cache/config.php \
      bootstrap/cache/routes-v7.php \
      bootstrap/cache/blade-icons.php

echo "==> Ricostruzione cache..."
php artisan cache:clear
php artisan view:clear
php artisan package:discover
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Migrazioni..."
php artisan migrate --force

echo "==> Deploy completato!"
