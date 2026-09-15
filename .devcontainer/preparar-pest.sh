#!/usr/bin/env bash
set -euo pipefail

if ! composer show pestphp/pest >/dev/null 2>&1 || ! composer show pestphp/pest-plugin-laravel >/dev/null 2>&1; then
    composer require "pestphp/pest:^3.8" "pestphp/pest-plugin-laravel:^3.2" --dev --with-all-dependencies
else
    echo "[OK] Pest y el plugin de Laravel ya estan instalados."
fi

if [ ! -f tests/Pest.php ]; then
    ./vendor/bin/pest --init
else
    echo "[OK] tests/Pest.php ya existe."
fi

php artisan test --filter=Avisos
