#!/usr/bin/env bash
# Deja Pest listo en tu proyecto para la sesion 6.
set -euo pipefail

if [ ! -f artisan ]; then
    echo "Aqui no hay proyecto Laravel (no encuentro 'artisan')."
    exit 1
fi

if ! composer show pestphp/pest >/dev/null 2>&1 || ! composer show pestphp/pest-plugin-laravel >/dev/null 2>&1; then
    composer require "pestphp/pest:^3.8" "pestphp/pest-plugin-laravel:^3.2" --dev --with-all-dependencies --no-interaction
else
    echo "[OK] Pest y el plugin de Laravel ya estan instalados."
fi

if [ ! -f tests/Pest.php ]; then
    ./vendor/bin/pest --init
else
    echo "[OK] tests/Pest.php ya existe."
fi

php artisan test --filter=Avisos
